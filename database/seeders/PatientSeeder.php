<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Category;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::factory(10)->create();

        Category::create(['name' => 'القطط']);
        Category::create(['name' => 'الكلاب']);

        for ($i = 1; $i < 11; $i++) {
            for ($m = 1; $m < 3; $m++) {
                Animal::create([
                    'patient_id' => $i,
                    'category_id' => $m,
                    'name' => 'حيوان ' . $m,
                ]);
            }
        }
    }
}
