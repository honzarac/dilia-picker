<?php

namespace DiliaPicker\Model;

class DiliaFacade
{
    /** @var DiliaClient */
    private $diliaClient;
    /** @var DiliaParser */
    private $diliaParser;

    public function __construct(DiliaClient $diliaClient, DiliaParser $diliaParser)
    {
        $this->diliaClient = $diliaClient;
        $this->diliaParser = $diliaParser;
    }

    public function refreshList()
    {
        $rawHtml = $this->diliaClient->loadSynopsePage(1);

        return $this->diliaParser->parseSynapsePageToSynopseEntity($rawHtml);
    }
}
