<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\subcategories;
use Faker\Generator as Faker;

$factory->define(subcategories::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->sentence,
        'category_id'=>factory(app\categories::class)
    ];
});
