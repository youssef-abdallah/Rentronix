<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\favourite_list;
use Faker\Generator as Faker;

$factory->define(favourite_list::class, function (Faker $faker) {
    return [
        'product_id'=>factory(app\products::class)
        // user id should be here
    ];
});
