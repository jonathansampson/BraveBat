<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stats\BatStats;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(BatStats::class, function (Faker $faker) {
    return [
        'holders_count' => $faker->numberBetween(100, 2000),
        'price' => $faker->numberBetween(0, 1000),
        'volume' => $faker->numberBetween(10000, 10000000),
        'market_cap' => $faker->numberBetween(100000, 10000000),
        'record_date' => Carbon::today()
    ];
});
