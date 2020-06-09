<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManageTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function create_post()
    {
        
        $user = factory('App\User')->create();

        $this->actingAs($user);

        $this->get('backend/blog/create');

        $post = factory('App\Post')->make();

        $this->post('/backend/blog/store')
            ->assertRedirect('/backend/blog/index');

    }


}
