<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'منتج ' . $this->faker->randomElement(['كلاب', 'قطط', 'عصافير', 'بط', 'دواجن']) .  ' ' .$this->faker->numberBetween(1, 30),
            'quantity' => $this->faker->numberBetween(30, 100),
            'sale_price' => $this->faker->numberBetween(50, 200),
        ];
    }
}
