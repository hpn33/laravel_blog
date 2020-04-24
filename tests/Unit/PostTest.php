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

}
