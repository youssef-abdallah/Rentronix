<?php

namespace Database\Factories;

use App\Models\ManufacturerInfo;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ManufacturerInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ManufacturerInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids= User::all()->pluck('id')->toArray();
        $ratings=array(1,2,3,4,5);
        return [
            'user_id'=>$this->faker->unique()->randomElement($ids),
            'rating'=>$this->faker->randomElement($ratings),
            'wallet'=>0.0,
            'percentage'=>5.0,
        ];
    }
}
