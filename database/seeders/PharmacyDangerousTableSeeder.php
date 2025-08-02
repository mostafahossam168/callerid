<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PharmacyDangerous;
use Illuminate\Support\Facades\DB;

class PharmacyDangerousTableSeeder extends Seeder
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
                'name' => 'آمن',
            ],
            [
                'name' => 'عالي المخاطر',
            ],
            [
                'name' => 'خطير جداً',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PharmacyDangerous::truncate();
        foreach ($data as $item) {
            PharmacyDangerous::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
