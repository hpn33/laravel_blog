<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::truncate();

        factory(Category::class, 4)->create();

        foreach (Post::all() as $post) {

            $post->update(['category_id' => rand(1, 4)]);

        }

    }
}
