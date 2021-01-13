<?php

namespace Database\Factories\Stats;

use App\Models\Stats\BatStats;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatStatsFactory extends Factory
{

    protected $model = BatStats::class;

    public function definition()
    {
        return [
            'holders_count' => $this->faker->numberBetween(100, 2000),
            'price' => $this->faker->numberBetween(0, 1000),
            'volume' => $this->faker->numberBetween(10000, 10000000),
            'market_cap' => $this->faker->numberBetween(100000, 10000000),
            'record_date' => Carbon::today(),
        ];
    }
}
