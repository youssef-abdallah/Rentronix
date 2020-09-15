<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\products;
use Faker\Generator as Faker;

$factory->define(products::class, function (Faker $faker) {
    return [
        'name' =>$faker->sentence ,
        'product_overview'=>$faker->paragraph,
        ' datasheet_url'=>$faker->imageUrl() ,
        ' image_url'=>$faker->imageUrl()    ,
        ' available_stock'=>$faker->numberBetween(300) ,
        ' rental_price' =>$faker->numberBetween(10000) ,
        ' selling_price'=>$faker->numberBetween(10000) ,
        'subcategory_id'=>factory(app\subcategories::class)
        // user id ,manufacture should be here
    ];
});
