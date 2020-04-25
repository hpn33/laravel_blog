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

        $this->withoutExceptionHandling();
        factory(Post::class, 10)->create();

        $posts = Post::forIndexPage();

        $response = $this->get('/index')->assertOk();

        foreach ($posts as $post) {

            $this->assertLessThanOrEqual(now()->timestamp, $post->published_at->timestamp);

            $response->assertSee($post->title)
                ->assertSee($post->excerpt)
                ->assertSee($post->author->name)
                ->assertSee($post->date);

        }

    }


    /** @test */
    function detail_of_post_on_show_page()
    {

        $post = create(Post::class, ['published_at' => now()]);

        $response = $this->get($post->path());

        $response->assertSee($post->title)
            ->assertSee($post->body)
            ->assertSee($post->author->name)
            ->assertSee($post->date);

        $response->assertSee($post->author->name);


    }

}
