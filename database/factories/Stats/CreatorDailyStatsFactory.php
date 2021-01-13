<?php

namespace Database\Factories\Stats;

use App\Models\Stats\CreatorDailyStats;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorDailyStatsFactory extends Factory
{
    protected $model = CreatorDailyStats::class;

    public function definition()
    {
        return [
            'channel' => 'youtube',
            'record_date' => today(),
            'total' => 1000,
            'addition' => 10,
        ];
    }

}
