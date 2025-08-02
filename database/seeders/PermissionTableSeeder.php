<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $permissions = config()->get('permission_groups');
        Permission::truncate();
        Role::truncate();
        $admin_role = Role::create(['name' => 'مدير']);
        $role2 = Role::create(['name' => 'الاستقبال']);
        $role3 = Role::create(['name' => 'الأطباء']);
        $role4 = Role::create(['name' => 'المحاسبين']);
        $role5 = Role::create(['name' => 'الأشعة']);
        $role6 = Role::create(['name' => 'المختبر']);
        $role7 = Role::create(['name' => 'الصيدلية']);
        $groups = array_keys(config()->get('permission_groups'));
        $permissions = [];
        foreach ($groups as $group) {
            foreach (config()->get('permission_groups.' . $group) as $index => $model) {
                foreach (config()->get('permission_groups.' . $group . '.' . $index) as $map) {
                    $permissions[] = $map . '_' . $index;
                }
            }
        }

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin_role->givePermissionTo($permission);
        }

        // $role3->givePermissionTo('عرض احصائيات المريض');


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
