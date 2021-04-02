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
        $this->client = new Client($this->endpoint, config('services.meili.private_key'));
        $this->indexName = $indexName;
        $this->index = $this->client->index($indexName);
    }

    public function getKeys()
    {
        $masterClient = new Client($this->endpoint, config('services.meili.master_key'));
        return $masterClient->getKeys();
    }

    public function createIndex()
    {
        $this->client->createIndex($this->indexName, [
            'primaryKey' => 'id',
        ]);
    }

    public function deleteIndex()
    {
        $this->client->deleteIndex($this->indexName);
    }

    public function getStats()
    {
        return $this->index->stats();
    }

    public function addDocument($creatorArray)
    {
        $this->index->addDocuments($creatorArray);
    }

    public function getSettings()
    {
        return $this->index->getSettings();
    }

    public function updateSettings()
    {
        $this->index->updateSettings([
            'rankingRules' => [
                'desc(ranking)',
                'typo',
                'words',
                'proximity',
                'attribute',
                'wordsPosition',
                'exactness',
            ],
            'searchableAttributes' => [
                'name',
            ],
            'displayedAttributes' => [
                '*',
            ],
            'attributesForFaceting' => [
                'channel',
            ],
            'stopWords' => null,
            'synonyms' => null,
            'distinctAttribute' => null,
        ]);
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
    // $service = new App\Services\CreatorSearchService("creators");
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
