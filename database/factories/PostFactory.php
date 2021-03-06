<?php

/** @var Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {

    $image = "Post_Image_" . rand(1, 5) . ".jpg";
    $date = tap(now())->addDays(-5);

    $title = $faker->sentence(rand(8, 12));

    $isPublished = rand(0, 1) == 0;

    return [
        'author_id' => factory(User::class),
        'title' => $faker->sentence(rand(8, 12)),
        'excerpt' => $faker->text(rand(250, 300)),
        'body' => $faker->paragraphs(rand(10, 15), true),
        'slug' => Str::slug($title),
        'image' => rand(0, 1) == 1 ? $image : NULL,

        'created_at' => $date,
        'updated_at' => $date,
        'published_at' => $isPublished ? null : tap(clone $date)->addDays(rand(0, 3)),

        'view_count' => $isPublished ? rand(0.0, 10.0) * 10 : 0
    ];
});
