<?php

namespace Database\Seeders;

use App\Models\PharmacyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmacyTypeTableSeeder extends Seeder
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
                'name' => 'اقراص',
            ],
            [
                'name' => 'شرب',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PharmacyType::truncate();
        foreach ($data as $item) {
            PharmacyType::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
