<?php

namespace Database\Factories;

use App\Models\BatPurchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatPurchaseFactory extends Factory
{
    protected $model = BatPurchase::class;

    public function definition()
    {
        return [
            'transaction_record' => $this->faker->uuid,
            'transaction_date' => $this->faker->date(),
            'transaction_amount' => $this->faker->numberBetween(10000, 1000000),
            'transaction_site' => $this->faker->randomElement(['Uphold', "Coinbase"]),
        ];
    }
}
