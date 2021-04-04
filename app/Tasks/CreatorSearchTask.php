<?php

namespace App\Tasks;

use App\Models\Creator;
use App\Services\CreatorSearchService;

class CreatorSearchTask
{
    // app("App\Tasks\CreatorSearchTask")->refresh();
    private $service;

    public function __construct()
    {
        $this->service = new CreatorSearchService('creators');
    }

    public function createIndex()
    {
        $this->service->createIndex();
        $this->service->updateSettings();
    }

    public function recreateIndex()
    {
        $this->service->deleteIndex();
        $this->service->createIndex();
        $this->service->updateSettings();
    }

    public function updateSetting()
    {
        $this->service->updateSettings();
    }

    public function createDump()
    {
        return $this->service->createDump();
    }

    public function refresh()
    {
        Creator::searchable()
            ->chunk(1000, function ($creators) {
                $creatorsArray = $creators->map(function ($creator) {
                    return $creator->toSearchArray();
                })->toArray();
                $this->service->addDocument($creatorsArray);
            });
    }

}
