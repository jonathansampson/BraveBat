<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Creator;
use Faker\Generator as Faker;

$factory->define(Creator::class, function (Faker $faker) {
    return [
        'creator' => 'bravebat.info',
        'channel' => 'website'
    ];
});
