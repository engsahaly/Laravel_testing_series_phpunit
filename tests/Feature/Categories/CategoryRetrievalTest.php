<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRetrievalTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_if_categories_page_opens_successfully(): void
    {
        $user = User::factory()->create();
       
        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertSeeText('Add New Category');
    }

    public function test_check_if_categories_page_contains_categories()
    {
        Category::factory()->count(4)->create();
        $user = User::factory()->create();
       
        $response = $this->actingAs($user)->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 4;
        });
    }

    public function test_check_if_pagination_works_as_expected()
    {
        Category::factory()->count(15)->create();
        $user = User::factory()->create();
       
        $response = $this->actingAs($user)->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 10;
        });

        $response = $this->actingAs($user)->get('/categories?page=2');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 5;
        });
    }
}
