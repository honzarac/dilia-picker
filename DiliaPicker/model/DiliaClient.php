<?php

namespace DiliaPicker\Model;

class DiliaClient
{
    const BASE_URL = 'http://www.dilia.cz/';

    public function loadSynopsePage($page = 1): string
    {
        $content = $this->loadPage(
            self::BASE_URL . 'synopse-her?page=' . $page
        );
        return $this->extractContent(
            $content,
            "<p>My cíp, dějiny niť trošek, do dá a podřízenému. Ah věk také lichvu curych</p>-->",
            "<div class=\"catalog-pagination\">"
        );
    }

    protected function extractContent($content, $begin, $end)
    {
        $content = explode(
            $begin,
            $content
        );
        $content = $content[1];
        $content = explode($end, $content);
        return $content[0];
    }

    private function loadPage($url): string
    {
         return file_get_contents($url);
//        $filename = __DIR__ . '/response-'.md5($url).'.html';
//
//        if (is_file($filename)) {
//            return file_get_contents($filename);
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
