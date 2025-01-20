<?php

namespace Tests\Smoke;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example_smoke(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
