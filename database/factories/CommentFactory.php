<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'rating'=>$this->faker->numberBetween(5) ,
            'content'=>$this->faker->paragraph ,
            'date_of_publishing'=>$this->faker->dateTime ,
            'product_id'=>$this->faker->randomElement($product),
            'user_id'=>$this->faker->randomElement($user)
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Comment $comment) {})->afterCreating(function (Comment $comment)
        {});
    }
}
