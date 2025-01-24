<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_check_if_homepage_works_fine(): void
    {
        // url "/"
        $response = $this->get(route('index'));
        // reponse status 200
        $response->assertStatus(200);
        // view opened successfully
        $response->assertViewIs('welcome');
        $response->assertSeeText('Laravel News');
    }
}
