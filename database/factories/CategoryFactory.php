<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return CategoryFactory
     */

    public function configure()
    {
        return $this->afterMaking(function (Category $category) {})->afterCreating(function (Category $category)
        {});
    }


    public function definition()
    {
        return [
            'title'=> $this->faker->sentence
        ];
    }
}
