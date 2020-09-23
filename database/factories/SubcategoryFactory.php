<?php

namespace Database\Factories;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubcategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subcategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Category::pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'category_id' => $this->faker->randomElement($categories),
        ];
    }
    
    public function configure()
    {
        return $this->afterMaking(function ( Subcategory $subcategory) {})->afterCreating(function ( Subcategory $subcategory)
        {});
    }
}
