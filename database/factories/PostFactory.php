<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
	
	$image = "Post_Image_" . rand(1, 5) . ".jpg";
    // $date = date("Y-m-d H:i:s", strtotime("2016-07-18 08:00:00 +{$i} days"));

    return [
		'author_id' => factory(User::class),
        'title' => $faker->sentence(rand(8, 12)),
        'excerpt' => $faker->text(rand(250, 300)),
        'body' => $faker->paragraphs(rand(10, 15), true),
        'slug' => $faker->slug(),
        'image' => rand(0, 1) == 1 ? $image : NULL,
        // 'created_at' => $date,
        // 'updated_at' => $date,
    ];
});
