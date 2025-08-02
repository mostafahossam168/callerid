<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kind_id' => $this->faker->numberBetween(1, 4),
            'name' => $this->faker->name,
            'quantity' => $this->faker->numberBetween(10, 100),
            'purchase_price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
