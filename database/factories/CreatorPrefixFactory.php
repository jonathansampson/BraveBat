<?php

namespace Database\Factories;

use App\Models\CreatorPrefix;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorPrefixFactory extends Factory
{
    protected $model = CreatorPrefix::class;

    public function definition()
    {
        return [
            'prefix' => $this->faker->word,
        ];
    }
}
