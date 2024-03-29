<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'value' => 'category_' . $faker->realText($faker->numberBetween(10,15)),
    ];
});
