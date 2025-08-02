<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Department;
use App\Models\Guarantor;
use App\Models\Product;
use App\Models\Project;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                User::truncate();
                Department::truncate();
                Relationship::truncate();
                City::truncate();
                Country::truncate();
                Product::truncate();
                Department::create(['name'=>'عيادة الحيوانات']);
                Department::create(['name'=>'مختبر']);
                Department::create(['name'=>'أشعة']);
                Relationship::create(['name'=>'متزوج']);
                City::create(['name'=>'الرياض']);
                Country::create(['name'=>'سعودي']);
                Product::create(['name'=>'كشف طبي','department_id'=>1,'price'=>100]);
                Product::create(['name'=>'تطعيم','department_id'=>1,'price'=>200]);
                $admin = User::create([
                        'name' => 'admin',
                        'email' => 'admin@admin.com',
                        'password' => Hash::make('123456'),
                        'type' => 'admin',

                ]);
                $rece = User::create([
                        'name' => 'استقبال',
                        'email' => 'r@r.r',
                        'password' => Hash::make('123456'),
                        'type' => 'recep',
                        'salary'=>'500',
                        'salary'=>'5',
                ]);
                $dr = User::create([
                        'name' => 'دكتور 1',
                        'email' => 'd@d.d',
                        'password' => Hash::make('123456'),
                        'type' => 'dr',
                        'salary'=>'500',
                        'salary'=>'5',
                        'department_id'=>'1'
                ]);
                $account = User::create([
                        'name' => 'محاسب',
                        'email' => 'a@a.a',
                        'password' => Hash::make('123456'),
                        'type' => 'accountant',
                        'salary'=>'500',
                        'salary'=>'5',
                ]);
                $scanner = User::create([
                        'name' => 'أشعة',
                        'email' => 's@s.s',
                        'password' => Hash::make('123456'),
                        'type' => 'scan',
                        'salary'=>'500',
                        'salary'=>'5',
                ]);
                $laber = User::create([
                        'name' => 'مختبر',
                        'email' => 'm@m.m',
                        'password' => Hash::make('123456'),
                        'type' => 'lab',
                        'salary'=>'500',
                        'salary'=>'5',
                ]);

                $pharmacy = User::create([
                        'name' => 'الصيدلية',
                        'email' => 'p@p.p',
                        'password' => Hash::make('123456'),
                        'type' => 'pharmacy',
                        'salary'=>'500',
                        'salary'=>'5',
                ]);

                $admin->assignRole(1);
                $rece->assignRole(2);
                $dr->assignRole(3);
                $account->assignRole(4);
                $scanner->assignRole(5);
                $laber->assignRole(6);
                $pharmacy->assignRole(7);
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
}
