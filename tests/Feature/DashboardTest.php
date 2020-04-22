<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    
    /** @test */
    public function public_pages()
    {

        $this->get('/dashboard')->assertOk();

    }

}
