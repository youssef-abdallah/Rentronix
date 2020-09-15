<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\products_comments;
use Faker\Generator as Faker;

$factory->define(products_comments::class, function (Faker $faker) {
    return [
        'rating'=>$faker->numberBetween(5) ,
        ' content'=>$faker->paragraph ,
        'date_of_publishing'=>$faker->dateTime ,
        'product_id'=>factory(app\products::class)
        // user id should be here
    ];
});
