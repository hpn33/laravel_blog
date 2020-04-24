<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Post;

class SeedTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function seeding()
    {

        $this->artisan('db:seed');

        $this->assertEquals(3, User::count());
        $this->assertEquals(10, Post::count());
    }

}
