<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemQuantity;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::factory(30)->create()->each(function (Item $item) {
            $item->all_quantities()->create([
                'quantity' => 10,
                'warehouse_id' => 1,
                'type' => 'charge',
                'employee_id' => 1,
                'last_update' => 1,
            ]);
        });
    }
}
