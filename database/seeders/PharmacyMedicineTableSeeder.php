<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PharmacyMedicine;
use Illuminate\Support\Facades\DB;

class PharmacyMedicineTableSeeder extends Seeder
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
                'name' => 'تيراميسين',
                'scientific_name' => 'terramycin',
                'pharmacy_warehouse_id' => 1,
                'opening_balance' => 100,
                'pharmacy_type_id' => 1,
                'pharmacy_dangerous_id' => 1,
                'barcode' => '12365',
                'purchasing_price' => 10,
                'selling_price' => 20,
                'expiry_date' => '2024-07-31',
                'operational_number' => '5001',

            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PharmacyMedicine::truncate();
        foreach ($data as $item) {
            PharmacyMedicine::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
