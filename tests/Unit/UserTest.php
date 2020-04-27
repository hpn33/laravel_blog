<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function has_many_posts()
    {

        $user = create(User::class);
        factory(Post::class, 10)->create(['author_id' => $user->id]);

        $this->assertInstanceOf(Post::class, $user->posts->first());

    }


    /** @test */
    function has_a_path()
    {

        $user = create(User::class);

        $this->assertEquals("/author/{$user->slug}", $user->path());

    }

}
