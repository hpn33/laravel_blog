<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // reset the posts table
        Post::truncate();

        // generate 10 dummy posts data
        factory(Post::class, 10)->create(['author_id' => rand(1, 3)]);
        
    }
}
