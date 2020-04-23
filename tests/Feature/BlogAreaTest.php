<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;

class BlogAreaTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function display_posts_in_index_page()
    {

        $posts = factory(Post::class, 10)->create();


        $response = $this->get('/index')->assertOk();

        foreach ($posts as $post)
        {

            $response->assertSee($post->title)
                ->assertSee($post->excerpt);
        
        }
    
    }
}
