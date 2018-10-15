<?php

namespace DiliaPicker\Model;

use Tester\DomQuery;

class DiliaParser
{
    /** @var DiliaClient */
    private $diliaClient;

    public function __construct(DiliaClient $diliaClient)
    {
        $this->diliaClient = $diliaClient;
    }

    public function parseSynapsePageToSynopseEntity(string $html)
    {
        $dom = DomQuery::fromHtml($html);

        $synopsies = [];
        foreach ($dom->find('.synopsis-thumb') as $synopsisThumb) {
            $synopsies[] =
        }
    }
}
