<?php

namespace Database\Seeders;

use App\Models\CustomerInfo;
use Illuminate\Database\Seeder;

class CustomerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerInfo::factory(5)->create();
    }
}
