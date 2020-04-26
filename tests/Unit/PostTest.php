<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

        $this->assertEquals("/posts/{$post->slug}", $post->path());

    }


    /** @test */
    function has_path_with_extension()
    {

        $post = create(Post::class);


        $extension = 'aa/a';

        $this->assertEquals("/posts/{$post->slug}/{$extension}", $post->path($extension));


        $extension = '';

        foreach (['aa', 'a'] as $ex) {

            $extension .= '/' . $ex;

        }

        $this->assertEquals("/posts/{$post->slug}" . $extension, $post->path(['aa', 'a']));

    }


    /** @test */
    function check_post_published()
    {

        $post = create(Post::class, ['published_at'=> now()]);

        $this->assertTrue($post->is_published());

    }


    /** @test */
    function check_post_unpublished()
    {

        $post = create(Post::class, ['published_at'=> null]);

        $this->assertTrue($post->not_published());

    }

}
