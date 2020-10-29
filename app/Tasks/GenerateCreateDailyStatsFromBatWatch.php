<?php

namespace App\Tasks;

use App\Models\Stats\CreatorDailyStats;
use App\Services\BatWatchService;

class GenerateCreateDailyStatsFromBatWatch
{
    public function generate()
    {
        $data = app(BatWatchService::class)->getData();
        $this->createDailyStats($data);
    }

    public function createDailyStats($data)
    {
        foreach ($data as $key => $value) {
            if ($key != 'total') {
                CreatorDailyStats::updateOrCreate(
                    [
                        'record_date' => today(),
                        'channel' => $key,
                    ],
                    [
                        'addition' => 0,
                        'total' => $value,
                    ]
                );
            }
        }
    }
}
