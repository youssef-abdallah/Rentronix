<?php

namespace Database\Factories;

use App\Models\FavouriteList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FavouriteListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FavouriteList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user= User::pluck('id')->toArray();
        $product= Product::pluck('id')->toArray();
        return [
            'product_id'=>$this->faker->randomElement($product),
            'user_id'=>$this->faker->randomElement($user)
        ];
    }
}
