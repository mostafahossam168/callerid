<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            SettingsTableSeeders::class,
            PermissionTableSeeder::class,
            UsersTableSeeder::class,
            StrainTableSeeder::class,
            PatientSeeder::class,
            RoomSeeder::class,
            KindSeeder::class,
            SupplySeeder::class,
            AccountSeeder::class,
            WarehouseSeeder::class,
            ItemSeeder::class,
            OrderSeeder::class,

            // pharmacy seeders
            PharmacyWarehouseTableSeeder::class,
            PharmacyTypeTableSeeder::class,
            PharmacyDangerousTableSeeder::class,
            PharmacyMedicineTableSeeder::class,
            PharmacyQuantityTableSeeder::class,
        ]);
    }
}
