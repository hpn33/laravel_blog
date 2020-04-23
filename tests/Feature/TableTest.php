<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Post;

class TableTest extends TestCase
{

    use RefreshDatabase;
    

    /** @test */
    public function seeding()
    {

        $this->artisan('db:seed');

        $this->assertEquals(3, User::count());
        $this->assertEquals(10, Post::count());
    }

    // /** @test */
    // public function can_create_users()
    // {

    //     $this->artisan('db:seed --class=UsersTableSeeder');

    //     $this->assertEquals(3, User::count());
    // }

    // /** @test */
    // public function can_create_post()
    // {

    //     $this->artisan('db:seed --class=PostsTableSeeder');

    //     $this->assertEquals(10, Post::count());
    // }

}
