<?php

namespace App\Tasks;

use App\Models\Stats\CreatorDailyStats;
use App\Services\BatGrowthService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GenerateCreateDailyStatsFromBatGrowth
{
    public function generate()
    {
        $data = app(BatGrowthService::class)->getData();
        $this->createDailyStats($data);
    }

    public function createDailyStats($data)
    {
        foreach ($data as $key => $value) {
            if ($key != 'total') {
                $creator_daily_stat = CreatorDailyStats::updateOrCreate(
                    [
                        'record_date' => today(),
                        'channel' => $key,
                    ],
                    [
                        'addition' => 0,
                        'total' => $value,
                    ]
                );
                $creator_daily_stat->generateAddition();
            }
        }

    }

    public function backfill($channel, $from, $to)
    {
        $period = CarbonPeriod::create($from, $to);
        $previous_total = CreatorDailyStats::where('channel', $channel)->where('record_date', $from)->first()->total;
        $new_total = CreatorDailyStats::where('channel', $channel)->where('record_date', $to)->first()->total;
        $diff = $new_total - $previous_total;
        $period = CarbonPeriod::create(Carbon::parse($from)->addDay(1)->toDateString(), $to);
        $additions = $this->getRandomNumbers($diff, count($period));
        foreach ($period as $index => $date) {
            $addition = $additions[$index];
            $previous_total += $addition;
            CreatorDailyStats::updateOrCreate(
                [
                    'record_date' => $date,
                    'channel' => $channel,
                ],
                [
                    'addition' => $addition,
                    'total' => $previous_total,
                ]
            );
        }
    }

    public function getRandomNumbers($total, $num_numbers)
    {
        $numbers = [];

        $loose_pcc = $total / $num_numbers;

        for ($i = 1; $i < $num_numbers; $i++) {
            // Random number +/- 10%
            $ten_pcc = $loose_pcc * 0.1;
            $rand_num = mt_rand(($loose_pcc - $ten_pcc), ($loose_pcc + $ten_pcc));

            $numbers[] = $rand_num;
        }

        // $numbers now contains 1 less number than it should do, sum
        // all the numbers and use the difference as final number.
        $numbers_total = array_sum($numbers);

        $numbers[] = $total - $numbers_total;

        return $numbers;
    }
}
