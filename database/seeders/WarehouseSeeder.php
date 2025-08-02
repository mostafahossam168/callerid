<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Warehouse::truncate();
        Warehouse::create(['name' => 'رئيسي', 'account_id' => 17]);
        Warehouse::create(['name' => 'محل', 'account_id' => 18]);
        Warehouse::create(['name' => 'عيادة', 'account_id' => 19]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
