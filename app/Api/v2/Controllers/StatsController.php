<?php

namespace App\Api\v2\Controllers;

use App\Api\v2\Controllers\ApiBaseController;
use App\Repositories\CreatorStatsRepository;

class StatsController extends ApiBaseController
{
    private $createStatsRepository;

    public function __construct(CreatorStatsRepository $createStatsRepository)
    {
        $this->createStatsRepository = $createStatsRepository;
    }

    public function creatorsByChannels()
    {
        return cache()->remember('creatorsByChannels', 86400, function () {
            return $this->createStatsRepository->creatorsByChannels();
        });
    }
}
