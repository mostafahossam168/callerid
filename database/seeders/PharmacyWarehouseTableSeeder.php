<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PharmacyWarehouse;
use Illuminate\Support\Facades\DB;

class PharmacyWarehouseTableSeeder extends Seeder
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
                'name' => 'مستودع اليرموك'
            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PharmacyWarehouse::truncate();
        foreach ($data as $item) {
            PharmacyWarehouse::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
