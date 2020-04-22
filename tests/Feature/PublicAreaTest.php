<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicAreaTest extends TestCase
{

    /** @test */
    public function public_pages()
    {

        $this->get('/')->assertOk();

    }

}
