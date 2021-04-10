<?php

namespace App\Console\Commands\Backfill;

use App\Models\Stats\CreatorDailyStats;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;

class BackFillCreatorFakeDailyStatsCommand extends Command
{
    ///TEMP
    protected $signature = 'backfill:fake_daily_stats';

    protected $description = 'Backfill Fake Creator Daily Stats';

    public function handle()
    {
        $period = CarbonPeriod::create('2021-01-19', '2021-04-09');

        foreach (config('bravebat.channels') as $channel) {
            $startingCount = CreatorDailyStats::where('channel', $channel)->where('record_date', '2021-01-18')->first()->total;
            $endingCount = CreatorDailyStats::where('channel', $channel)->where('record_date', '2021-04-10')->first()->total;
            $rawDailyAddition = floor(($endingCount - $startingCount) / 80);
            foreach ($period as $date) {
                $startingCount += $rawDailyAddition;
                CreatorDailyStats::updateOrCreate(
                    [
                        'record_date' => $date,
                        'channel' => $channel,
                    ],
                    [
                        'addition' => $rawDailyAddition,
                        'total' => $startingCount,
                    ]
                );
            }
        }
    }
}
