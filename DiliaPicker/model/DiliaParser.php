<?php

namespace DiliaPicker\Model;

use PHPHtmlParser\Dom;

class DiliaParser
{
    /** @var DiliaClient */
    private $diliaClient;

    public function __construct(DiliaClient $diliaClient)
    {
        $this->diliaClient = $diliaClient;
    }

    public function parseSynapsePageToSynopseEntity(string $html): array
    {
        $dom = new Dom();
        $dom->loadStr($html);

        $synopsies = [];
        foreach ($dom->find('.synopsis-thumb') as $synopsisThumb) {

            $translator = $synopsisThumb->find('.translate a');
            $allP = $synopsisThumb->find('p')->toArray();
            $lastPTag = end($allP);

            $synopsies[] = new Synopsy(
                $this->parseMainName($synopsisThumb->find('.synopsis-title')[0]->innerHtml),
                $this->parseOriginalName($synopsisThumb->find('.synopsis-title')[0]->innerHtml),
                $synopsisThumb->find('a')[0]->getAttribute('href'),
                trim(strip_tags($synopsisThumb->find('.author')[0]->innerHtml)),
                trim($lastPTag->innerHtml),
                $translator[0] ? trim($translator[0]->innerHtml) : null
            );
        }
        return $synopsies;
    }

    public function parseMainName($title)
    {
        preg_match('/\(([a-zA-Z0-9- !@#$%^&*,._]*)\)/', $title, $matches);
        if(count($matches) > 0) {
            $title = str_replace('('.end($matches).')', '', $title);
        }
        return $title;
    }

    public function parseOriginalName($title)
    {
        preg_match('/\(([a-zA-Z0-9- !@#$%^&*,._]*)\)/', $title, $matches);
        if(count($matches) > 0) {
            return end($matches);
        }
        return null;
    }
}
