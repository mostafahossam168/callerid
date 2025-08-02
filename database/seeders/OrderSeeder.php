<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        Order::factory(10)->create();

        for ($i = 1; $i < 11; $i++) {
            for ($m = 1; $m < 4; $m++) {
                $price = $this->faker->numberBetween(100, 500);
                $quantity = $this->faker->numberBetween(1, 5);
                OrderItem::create([
                    'order_id' => $i,
                    'item_id' => $this->faker->numberBetween(1, 30),
                    'sale_price' => $price,
                    'quantity' => 1,
                    'total' => 1 * $price,
                    'warehouse_id' => 1,
                ]);
            }
        }
    }
}
