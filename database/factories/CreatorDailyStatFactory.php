<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stats\CreatorDailyStats;
use Faker\Generator as Faker;

$factory->define(CreatorDailyStats::class, function (Faker $faker) {
    return [
        'channel' => 'youtube',
        'record_date' => today(),
        'total' => 1000,
        'addition' => 10,
    ];
});
