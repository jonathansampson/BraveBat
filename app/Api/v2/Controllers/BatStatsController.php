<?php

namespace App\Api\v2\Controllers;

use App\Api\v2\Controllers\ApiBaseController;
use App\Models\Stats\BatStats;
use App\Resources\BatStatsResource;

class BatStatsController extends ApiBaseController
{
    public function all()
    {
        return cache()->remember('batStatsAll', 86400, function () {
            return BatStatsResource::collection(BatStats::orderBy('record_date', 'desc')->get());
        });
    }
}
