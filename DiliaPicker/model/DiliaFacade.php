<?php

namespace DiliaPicker\Model;

use Nextras\Dbal\Connection;

class DiliaFacade
{
    /** @var DiliaClient */
    private $diliaClient;

    /** @var DiliaParser */
    private $diliaParser;

    /** @var Connection */
    private $connection;

    public function __construct(
        DiliaClient $diliaClient,
        DiliaParser $diliaParser,
        Connection $connection
    ) {
        $this->diliaClient = $diliaClient;
        $this->diliaParser = $diliaParser;
        $this->connection = $connection;
    }

    public function refreshList(int $page): int
    {
        $rawHtml = $this->diliaClient->loadSynopsePage($page);

        $synopseEntities = $this->diliaParser->parseSynapsePageToSynopseEntity($rawHtml);

        foreach ($synopseEntities as $synopsy) {
            $this->saveSynopse($synopsy);
        }
        return count($synopseEntities);
    }

    public function saveSynopse(Synopsy $synopsy)
    {
        $this->connection->query(
            'INSERT INTO [synopsy] %values',
            [
                'name' => $synopsy->name,
                'name_en' => $synopsy->nameEn,
                'detail_href' => $synopsy->detailHref,
                'author' => $synopsy->author,
                'literal_starring' => $synopsy->literalStarring,
                'translator' => $synopsy->translator,
            ]
        );
    }
}
