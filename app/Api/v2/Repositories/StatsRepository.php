<?php

namespace App\Api\v2\Repositories;

use Illuminate\Support\Facades\DB;

class StatsRepository
{
    public function creatorsByChannels()
    {
        return DB::select("SELECT
                channel AS category,
                count(id) AS data
            FROM
                creators
            GROUP BY
                channel
            ORDER BY
                data desc");
    }
}
