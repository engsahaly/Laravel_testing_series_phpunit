<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRetrievingTest extends TestCase
{
    use RefreshDatabase;

    // protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->user = User::factory()->create();
        $this->actingAs(User::factory()->create());
    }

    public function test_check_if_categories_page_opens_successfully(): void
    {
        $response = $this->get('/categories');

        $response
        ->assertStatus(200)
        ->assertViewIs('categories.index')
        ->assertSeeText('Add New Category');
    }

    public function test_check_if_categories_page_contains_categories()
    {
        Category::factory()->count(4)->create();
       
        $response = $this->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 4;
        });
    }

    public function test_check_if_pagination_works_as_expected()
    {
        Category::factory()->count(15)->create();
       
        $response = $this->get('/categories');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 10;
        });

        $response = $this->get('/categories?page=2');

        $response->assertViewHas('categories', function ($categories) {
            return $categories->count() === 5;
        });
    }

    // public function getUser()
    // {
    //     return User::factory()->create();
    // }

    public function test_check_if_categories_show_page_contains_the_right_content(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.show', $category));

        $response
        ->assertStatus(200)
        ->assertViewIs('categories.show')
        ->assertViewHas('category', $category)
        ->assertSeeText($category->name)
        ->assertSeeText($category->description);
    }
}
