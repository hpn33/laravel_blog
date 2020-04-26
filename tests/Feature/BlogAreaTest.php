<?php

namespace Tests\Feature;

use App\Category;
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

        $this->withoutExceptionHandling();
        $category = create(Category::class);
        $post = create(Post::class, [
            'published_at' => now(),
            'category_id' => $category->id
        ]);

        $this->get($post->path())
            ->assertSee($post->title)
            ->assertSeeTextInOrder(preg_split('/[\n\r]+/', $post->body))
            ->assertSee($post->author->name)
            ->assertSee($post->date);

    }

    /** @test */
    function cannot_show_unpublished_post()
    {

        $post = create(Post::class, ['published_at' => null]);

        $this->get($post->path())->assertStatus(404);

    }


    /** @test */
    function show_post_on_category()
    {

        $this->withoutExceptionHandling();
        $category = create(Category::class);
        factory(Post::class, 10)->create([
            'category_id' => $category->id
        ]);

        $posts = Post::filterBy($category)->forIndexPage(3);

        $this->get($category->path())
            ->assertOk()
            ->assertSee($posts[0]->title)
            ->assertSee($posts[1]->title)
            ->assertSee($posts[2]->title);

    }

}
