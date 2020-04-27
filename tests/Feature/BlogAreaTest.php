<?php

namespace Tests\Feature;

use App\Category;
use App\User;
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

        $response = $this->get('/index')->assertOk();

        foreach (Post::forIndexPage() as $post) {

            $this->assertLessThanOrEqual(now()->timestamp, $post->published_at->timestamp);

            $response->assertSee($post->title)
                ->assertSee($post->excerpt)
                ->assertSee($post->author->slug)
                ->assertSee($post->date);

        }

    }


    /** @test */
    function detail_of_post_on_show_page()
    {

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

        $category = create(Category::class);
        factory(Post::class, 10)->create([
            'category_id' => $category->id
        ]);

        $posts = $category->posts()->published()->forIndexPage(3);

        $response = $this->get($category->path())->assertOk();

        foreach ($posts as $post)
        {

            $response->assertSee($post->title);

        }

    }

    /** @test */
    function see_empty_message_on_category_page()
    {

        $category = create(Category::class);

        $this->get($category->path())
            ->assertSee('Nothing Found')
            ->assertSee($category->title)
            ->assertSee($category->title);

    }


    /** @test */
    function show_post_by_author()
    {

        $user = create(User::class);
        factory(Post::class, 20)->create(['author_id' => $user->id]);

        $posts = $user->posts()->forIndexPage(3);

        $this->get($user->path())
            ->assertOk()
            ->assertSee($posts[0]->title)
            ->assertSee($posts[1]->title)
            ->assertSee($posts[2]->title);

    }

}
