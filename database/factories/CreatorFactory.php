<?php

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{

    protected $model = Creator::class;

    public function definition()
    {
        return [
            'creator' => 'bravebat.info',
            'channel' => 'website',
            'name' => $this->faker->name,
        ];
    }
}
