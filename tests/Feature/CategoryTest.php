<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example_custom(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function test_example_custom2(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    // Will not execute
    public function example_custom2(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_test1(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // snake_case -- allowed
    public function test_check_if_home_page_works_fine(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // Camel Case - allowed
    public function testCheckIfHomePageWorksFine(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // Pascal Case -- not allowed
    // public function TestCheckIfHomePageWorksFine(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // Kebab Case -- not allowed
    // public function test-check-if-home-page-works-fine(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

}
