<?php

namespace DiliaPicker\Model;

class DiliaClient
{
    const BASE_URL = 'http://www.dilia.cz/';

    public function loadSynopsePage($page = 1): string
    {
        return $this->loadPage(sprintf('%s%s%n', self::BASE_URL, 'synopse-her?page=', $page));
    }

    private function loadPage($url): string
    {
        return file_get_contents($url);
    }
}
