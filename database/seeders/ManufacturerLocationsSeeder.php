<?php

namespace Database\Seeders;

use App\Models\ManufacturerLocation;
use Illuminate\Database\Seeder;

class ManufacturerLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManufacturerLocation::factory(5)->create();
    }
}
