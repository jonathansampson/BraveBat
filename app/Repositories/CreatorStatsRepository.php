<?php

namespace App\Repositories;

use App\Models\Stats\CreatorDailyStats;
use Illuminate\Support\Facades\DB;

class CreatorStatsRepository
{
    public function creatorsByChannels()
    {
        $lastDate = CreatorDailyStats::orderBy('record_date', 'desc')->first()->record_date;
        return DB::select("SELECT
            c.channel,
            c.total as total_today,
            (select total from creator_daily_stats where channel = c.channel and record_date >= '{$lastDate}' - interval 7 day order by record_date limit 1) as total_7d_ago,
            (select total from creator_daily_stats where channel = c.channel and record_date >= '{$lastDate}' - interval 30 day order by record_date limit 1) as total_1m_ago,
            (select total from creator_daily_stats where channel = c.channel and record_date >= '{$lastDate}' - interval 90 day order by record_date limit 1) as total_3m_ago,
            (select total from creator_daily_stats where channel = c.channel and record_date >= '{$lastDate}' - interval 365 day order by record_date limit 1) as total_1y_ago
        FROM
            creator_daily_stats c where c.record_date = '{$lastDate}' order by c.total desc");
    }
}
