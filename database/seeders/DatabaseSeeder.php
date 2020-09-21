<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\CustomerInfo;
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
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            ManufacturerInfoSeeder::class,
            CustomerInfoSeeder::class,
            ManufacturerLocationsSeeder::class,
            AbilitySeeder::class,
        ]);
    }
}
