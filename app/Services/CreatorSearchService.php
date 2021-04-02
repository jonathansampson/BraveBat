<?php

namespace App\Services;

use App\Models\Creator;
use MeiliSearch\Client;

class CreatorSearchService
{
    private $client;
    private $index;
    private $indexName;
    private $endpoint;

    public function __construct($indexName = "creators")
    {
        $this->endpoint = "http://127.0.0.1:7700";
        $this->client = new Client($this->endpoint);
        $this->indexName = $indexName;
        $this->index = $this->client->index($indexName);
    }

    public function createIndex()
    {
        $this->client->createIndex($this->indexName, ['primaryKey' => 'id']);
    }

    public function deleteIndex()
    {
        $this->client->deleteIndex($this->indexName);
    }

    public function addDocument($creatorArray)
    {
        $this->index->addDocuments($creatorArray);
    }

    public function updateSearchableAttributes()
    {
        $this->index->updateSearchableAttributes([
            'name',
        ]);
    }

    public function updateRankingRules()
    {
        $this->index->updateRankingRules([
            'desc(ranking)',
            'typo',
            'words',
            'proximity',
            'attribute',
            'wordsPosition',
            'exactness',
        ]);
    }

    public function getRankingRules()
    {
        return $this->index->getRankingRules();
    }

    public function deleteDocument($id)
    {
        $this->index->deleteDocument($id);
    }

    public function search($term)
    {
        return $this->index->search($term);
    }

    // use App\Services\CreatorSearchService;
    // $service = new CreatorSearchService("creators");
    // $service->massIndex();
    public function massIndex()
    {
        Creator::chunk(10000, function ($creators) {
            $creatorsArray = $creators->map(function ($creator) {
                return $creator->toSearchArray();
            })->toArray();
            $this->addDocument($creatorsArray);
        });
    }
}
