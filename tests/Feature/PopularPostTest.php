<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PopularPostTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function it_()
    {

        factory(Post::class, 10)->create();

        $prv = 0;

        foreach (Post::byPopularity()->published()->get() as $post) {

            $this->assertNotNull($post->published_at);
            $this->assertLessThanOrEqual($post->view_count, $prv);

            $prv = $post->view_count;

        }


    }


}
