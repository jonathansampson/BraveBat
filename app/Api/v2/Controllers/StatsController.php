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
     *     summary="Get Creator Counts by Channels",
     *     tags={"Stats"},
     *     @OA\Response(
     *      response=200,
     *      description="A list of creator counts by chanenels",
     *      @OA\JsonContent(ref="#/components/schemas/CreatorCountArray")
     *     )
     * )
     */
    public function creatorsByChannels()
    {
        return cache()->remember('creatorsByChannels', 86400, function () {
            return $this->statsRepository->creatorsByChannels();
        });
    }
}
