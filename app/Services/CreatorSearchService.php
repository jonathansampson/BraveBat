<?php

namespace App\Services;

use MeiliSearch\Client;

class CreatorSearchService
{
    private $client;
    private $index;
    private $indexName;
    private $endpoint;

    // new CreatorSearchService('creators')
    public function __construct($indexName)
    {
        $this->endpoint = config('services.meili.endpoint');
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

    public function search($term, $channels = [], $offset = null)
    {
        $options = [
            'attributesToHighlight' => ['name'],
            'facetsDistribution' => ['channel'],
            'limit' => 20,
            'offset' => $offset,
        ];
        if (count($channels)) {
            $options['facetFilters'] = [];
            $channelArray = array_map(function ($channel) {
                return 'channel:' . $channel;
            }, $channels);
            $options['facetFilters'] = [$channelArray];
        }
        return $this->index->search($term, $options);
    }

}
