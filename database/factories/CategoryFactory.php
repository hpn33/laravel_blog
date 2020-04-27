<?php

/** @var Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {

    $name = $faker->sentence(2);

    return [
        'title' => $name,
        'slug' => Str::slug($name)
    ];
});
