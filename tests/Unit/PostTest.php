<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function any_post_has_a_path()
    {

        $post = create(Post::class);

        $this->assertEquals("/posts/{$post->id}", $post->path());

    }

}
