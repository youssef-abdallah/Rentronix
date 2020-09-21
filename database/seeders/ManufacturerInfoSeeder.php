<?php

namespace Database\Seeders;

use App\Models\ManufacturerInfo;
use Illuminate\Database\Seeder;

class ManufacturerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ManufacturerInfo::factory(5)->create();
    }
}
