<?php

namespace DiliaPicker\Model;

use DiliaPicker\Exceptions\UnexpectedDiliaResponseException;

class DiliaClient
{
    const BASE_URL = 'https://www.dilia.cz/';

    public function loadSynopsePage($page = 1): string
    {
        $content = $this->loadPage(
            self::BASE_URL . 'synopse-her?page=' . $page
        );
        return $this->extractContent(
            $content,
            'My cíp, dějiny niť trošek, do dá a podřízenému. Ah věk také lichvu curych</p>-->',
            '<div class="catalog-pagination">'
        );
    }

    protected function extractContent($content, $begin, $end)
    {
        $matchResult = preg_match(
            sprintf('@%s(.*)%s@ms', preg_quote($begin), preg_quote($end)),
            $content,
            $matches
        );
        if ($matchResult === false || $matchResult === 0) {
            throw new UnexpectedDiliaResponseException('Nepodařilo se najít content v dilia response');
        }
        return $matches[1];
    }

    private function loadPage($url): string
    {
//         return file_get_contents(
//             $url,
//             false,
//             stream_context_create([
//                 "ssl" => [
//                     'verify_peer' => false,
//                     'verify_peer_name' => false,
//                 ],
//             ])
//         );
//        $filename = __DIR__ . '/response-'.md5($url).'.html';
//
//        if (is_file($filename)) {
        return file_get_contents(__DIR__ . '/../../data/test.html');
//        } else {
//            $content = file_get_contents($url);
//            file_put_contents(
//                $filename,
//                $content
//            );
//            return $content;
//        }
    }
}
