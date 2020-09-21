<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======

>>>>>>> 657cabfa3b05b32899ef15ce84e766e80654f7c7

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
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Category $category) {})->afterCreating(function (Category $category)
        {});
    }
}
