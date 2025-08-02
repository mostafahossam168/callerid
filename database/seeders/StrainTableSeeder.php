<?php

namespace Database\Seeders;

use App\Models\Strain;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strainCategories = [
            [
                'name' => 'الزواحف'
            ],
            [
                'name' => 'المواشي'
            ],
            [
                'name' => 'الخيول'
            ],
            [
                'name' => 'الصقور'
            ],
            [
                'name' => 'القطط'
            ],
            [
                'name' => 'الكلاب'
            ],
        ];
        $strains = [
            [
                'name' => 'برمائي',
                'category_id' => 1
            ],
            [
                'name' => 'نعيمى',
                'category_id' => 2
            ],
            [
                'name' => 'عربية',
                'category_id' => 3
            ],
            [
                'name' => 'صيد',
                'category_id' => 6
            ],
            [
                'name' => 'شاهين',
                'category_id' => 4
            ],
            [
                'name' => 'شيرازي',
                'category_id' => 5
            ],
            [
                'name' => 'قط برى',
                'category_id' => 5
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Strain::truncate();
        foreach ($strainCategories as $item) {
            Category::create($item);
        }
        foreach ($strains as $strain) {
            Strain::create($strain);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
