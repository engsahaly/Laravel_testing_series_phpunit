<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->user = User::factory()->create();
        if ($this->name() !== 'test_prevent_unauthenticated_user_from_listing_categories') {
            Sanctum::actingAs(
                User::factory()->create(),
            );
        }
    }

    // public function authenticateUser()
    // {
    //     Sanctum::actingAs(
    //         User::factory()->create(),
    //     );
    // }

    public function test_prevent_unauthenticated_user_from_listing_categories(): void
    {
        $response = $this->getJson('/api/categories');    

        $response->assertStatus(401);
    }   

    public function test_list_all_categories(): void
    {
        Category::factory()->count(5)->create();

        // $this->authenticateUser();
        $response = $this->getJson('/api/categories');    

        $response
        ->assertStatus(200)
        ->assertJsonCount(5, 'data');
    }

    public function test_create_category(): void
    {
        $category = Category::factory()->make();

        $response = $this->postJson('/api/categories', $category->toArray());    

        $response
        ->assertStatus(201)
        ->assertJsonFragment(['name' => $category->name]);
    }

    public function test_show_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->id}");    

        $response
        ->assertStatus(200)
        ->assertJsonFragment(['name' => $category->name]);
    }

    public function test_update_category(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'Updated Category',
            'description' => 'Updated Description'
        ];

        $response = $this->putJson("/api/categories/{$category->id}", $updatedCategory);    

        $response
        ->assertStatus(200)
        ->assertJsonFragment(['name' => $updatedCategory['name']]);
    }

    public function test_delete_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");    

        $response->assertStatus(204);
    }
}
