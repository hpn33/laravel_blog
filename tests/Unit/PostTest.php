<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Generator as Faker;

class PostTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function has_a_author()
    {

        $this->assertInstanceOf(User::class, create(Post::class)->author);

    }

    /** @test */
    function just_published_posts()
    {

        factory(Post::class, 20)->create();

        $this->assertEquals(
            Post::where('published_at', '<=', now())->get()->count(),
            Post::published()->count());

    }


    /** @test */
    function has_path()
    {

        $post = create(Post::class);

        $this->assertEquals("/{$post->id}", $post->path());

    }


    /** @test */
    function has_path_with_extension()
    {

        $post = create(Post::class);


        $extension = 'aa/a';

        $this->assertEquals("/{$post->id}/{$extension}", $post->path($extension));


        $extension = '';

        foreach (['aa', 'a'] as $ex) {

            $extension .= '/' . $ex;

        }

        $this->assertEquals("/{$post->id}" . $extension, $post->path(['aa', 'a']));

    }

}
