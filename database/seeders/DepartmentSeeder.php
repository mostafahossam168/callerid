<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::firstOrCreate(
            ['key' => 'hotel_service'],
            ['name' => 'خدمات فندقية', 'transferstatus' => 0]);
    }
}
