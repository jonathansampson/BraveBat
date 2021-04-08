<?php

namespace App\Api\v2\Controllers;

use App\Api\v2\Controllers\ApiBaseController;
use App\Api\v2\Repositories\StatsRepository;

class StatsController extends ApiBaseController
{
    private $statsRepository;

    public function __construct(StatsRepository $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    /**
     * @OA\Get(
     *     path="/stats/creators_by_channels",
     *     summary="This is summary",
     *     description="This is a description",
     *     @OA\Response(
     *      response=200,
     *      description="A list with products"
     *     ),
     * )
     */
    public function creatorsByChannels()
    {
        return cache()->remember('creatorsByChannels', 86400, function () {
            return $this->statsRepository->creatorsByChannels();
        });
    }
}
