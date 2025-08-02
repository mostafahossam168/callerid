<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = $this->faker->numberBetween(100, 1000);
        $total = $amount + $this->faker->numberBetween(50, 100);

        return [
            'patient_id' => $this->faker->numberBetween(1, 5),
            'animal_id' => $this->faker->numberBetween(1, 2),
            'employee_id' => 1,
            'date' => date('Y-m-d'),
            'status' => 'paid',
            'amount' => $amount,
            'total' => $total,
            'cash' => $total,
        ];
    }
}
