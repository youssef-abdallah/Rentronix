<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'rating'=>$faker->numberBetween(5) ,
        ' content'=>$faker->paragraph ,
        'date_of_publishing'=>$faker->dateTime ,
        'product_id'=>factory(app\products::class)
        // user id should be here
    ];
});
