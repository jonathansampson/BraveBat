<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CreatorStatsRepository
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
