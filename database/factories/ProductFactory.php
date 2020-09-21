<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subcategory= Subcategory::pluck('id')->toArray();
        $user= User::pluck('id')->toArray();
        return [

            'name' =>$this->faker->sentence ,
            'product_overview'=>$this->faker->paragraph,
            'datasheet_url'=>$this->faker->imageUrl() ,
            'image_url'=>$this->faker->imageUrl()    ,
            'available_stock'=>$this->faker->numberBetween(300) ,
            'rental_price' =>$this->faker->numberBetween(10000) ,
            'selling_price'=>$this->faker->numberBetween(10000) ,
            'subcategory_id'=>$this->faker->randomElement($subcategory),
            'owner_id'=>$this->faker->randomElement($user)

        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Product $product) {})->afterCreating(function (Product $product)
        {});
    }
}
