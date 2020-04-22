<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManageTest extends TestCase
{
    

    use RefreshDatabase;


    /** @test */
    function a_user_can_create_a_post()
    {

        $this->withoutExceptionHandling();


        $this->signIn();

        $this->get('/posts/create');

        $post = make('App\Post');

        $response = $this->post('/posts', $post->toArray());
        
        $this->get($response->headers->get('Location'))
            ->assertSee($post->title)
            ->assertSee($post->body);

    }

}
