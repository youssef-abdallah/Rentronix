<?php

namespace Database\Factories;

use App\Models\ManufacturerInfo;
use App\Models\ManufacturerLocation;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ManufacturerLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ManufacturerLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids= User::all()->pluck('id')->toArray();
        return [
            'manufacturer_id'=>$this->faker->randomElement($ids),
            'address'=>$this->faker->address,
        ];
    }
}
