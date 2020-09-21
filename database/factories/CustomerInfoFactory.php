<?php

namespace Database\Factories;

use App\Models\CustomerInfo;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids= User::all()->pluck('id')->toArray();
        return [
            'user_id'=>$this->faker->unique()->randomElement($ids),
            'address'=>$this->faker->address,
            'wallet'=>0.0
        ];
    }
}
