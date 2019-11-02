<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $img = [
        '1.png',
        '2.png',
        '3.jpg',
        '4.jpeg',
        '5.jpg',
    ];
    return [
        'category_id' => rand(1, 12),
        'name' => $faker->sentence(1),
        'description' => $faker->realText($faker->numberBetween(50, 100)),
        'image' => '/img/' . $img[array_rand($img, 1)]
    ];
});
