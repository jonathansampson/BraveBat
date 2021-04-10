<?php

namespace App\Console\Commands\Backfill;

use App\Models\Stats\CreatorDailyStats;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;

class BackFillCreatorDailyStatsCommand extends Command
{
    protected $signature = 'backfill:daily_stats';

    protected $description = 'Backfill Creator Daily Stats';

    public function handle()
    {
        $period = CarbonPeriod::create('2021-01-19', '2021-04-05');
        foreach ($period as $date) {
            CreatorDailyStats::generate($date->toDateString());
        }
    }
}
