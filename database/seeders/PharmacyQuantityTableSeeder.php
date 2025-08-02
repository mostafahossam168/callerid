<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PharmacyQuantity;
use Illuminate\Support\Facades\DB;

class PharmacyQuantityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'item_type' => 'App\\Models\\PharmacyMedicine',
                'item_id' => 1,
                'quantity' => 10,
                'pharmacy_warehouse_id' => 1,
                'from_warehouse_id' => null,
                'to_warehouse_id' => null,
                'type' => 'charge',
                'employee_id' => 1,
                'last_update' => null,
                'operational_number' => '5000',

            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PharmacyQuantity::truncate();
        foreach ($data as $item) {
            PharmacyQuantity::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
