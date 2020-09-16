<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::factory(20)->create();

        $abilities = Ability::all();

        Role::all()->each(function ($role) use ($abilities) {
            $role->Ability()->attach(
                $abilities->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
