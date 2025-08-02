<?php

namespace Database\Seeders;

use App\Models\Supply;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Supply::factory()->count(30)->create();

        $data = [
            'مسحات طبية',
            'ادوات تنظيف',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Supply::truncate();
        foreach ($data as $name) {
            Supply::create([
                'kind_id' => rand(1, 4),
                'quantity' => rand(10, 100),
                'purchase_price' => rand(100, 1000),
                'name' => $name

            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
