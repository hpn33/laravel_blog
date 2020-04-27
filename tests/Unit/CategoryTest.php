<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function has_many_posts()
    {

        $this->withoutExceptionHandling();

        factory(Post::class, 10)
            ->create([
                'category_id' => create(Category::class)->id
            ]);

        $this->assertInstanceOf(Post::class, Category::first()->posts()->first());

    }


    /** @test */
    function has_path()
    {

        $category = create(Category::class);

        $this->assertEquals("/category/{$category->slug}", $category->path());

    }

}
