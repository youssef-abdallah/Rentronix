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
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ManufacturerInfoSeeder::class);
        $this->call(CustomerInfoSeeder::class);
        $this->call(ManufacturerLocationsSeeder::class);
        $this->call(AbilitySeeder::class);
        // User::factory(10)->create();
    }
}
