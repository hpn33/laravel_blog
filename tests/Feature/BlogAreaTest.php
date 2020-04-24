<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Post;

class BlogAreaTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function display_posts_in_index_page()
    {

        factory(Post::class, 10)->create();

        $posts = Post::forIndexPage();

        $response = $this->get('/index')->assertOk();

        foreach ($posts as $post)
        {

            $this->assertLessThanOrEqual(now()->timestamp, $post->published_at->timestamp);

            $response->assertSee($post->title)
                ->assertSee($post->excerpt)
                ->assertSee($post->author)
                ->assertSee($post->date);

        }

    }
}
