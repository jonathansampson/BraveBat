<?php

namespace App\Api\v2\Controllers;

use App\Api\v2\Controllers\ApiBaseController;
use App\Repositories\CreatorStatsRepository;

class StatsController extends ApiBaseController
{
    private $creatorStatsRepository;

    public function __construct(CreatorStatsRepository $creatorStatsRepository)
    {
        $this->creatorStatsRepository = $creatorStatsRepository;
    }

    public function creatorsByChannels()
    {
        return cache()->remember('creatorsByChannels', 86400, function () {
            return $this->creatorStatsRepository->creatorsByChannels();
        });
    }
}
