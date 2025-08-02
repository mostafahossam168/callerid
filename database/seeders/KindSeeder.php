<?php

namespace Database\Seeders;

use App\Models\Kind;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Kind::truncate();
        Kind::create(['name'=>'1 القسم الرئيسي']);
        Kind::create(['name'=>'القسم الفرعي 1','parent'=>1]);
        Kind::create(['name'=>'القسم الرئيسي 2']);
        Kind::create(['name'=>'القسم الفرعي 2','parent'=>3]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
