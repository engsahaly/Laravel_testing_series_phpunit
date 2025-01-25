<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryUpdatingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();        
    }

    public function test_check_if_category_edit_page_contains_the_right_content(): void
    {
        $category = Category::factory()->create();
        
        $response = $this->actingAs($this->user)->get(route('categories.edit', $category));    

        $response
        ->assertStatus(200)
        ->assertViewIs('categories.edit')
        ->assertViewHas('category', $category)
        ->assertSee($category->name)
        ->assertSee($category->description);
    }
    
    public function test_update_category(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'updated test name',
            'description' => 'updated test description'
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertRedirect(route('categories.index'))
        ->assertSessionHas('success', 'Category updated successfully');

        $this->assertDatabaseHas('categories', $updatedCategory);
        $this->assertDatabaseMissing('categories', $category->toArray());
    }
    
    public function test_category_name_is_required(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => '',
            'description' => 'updated test description'
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertSessionHasErrors('name', 'The name field is required.');

        $this->assertDatabaseMissing('categories', $updatedCategory);
    }
    
    public function test_check_category_name_must_be_at_least_3_characters(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'aa',
            'description' => 'updated test description'
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertSessionHasErrors('name');
    }
    
    public function test_check_category_name_must_be_at_most_255_characters(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => str_repeat('a', 256),
            'description' => 'updated test description'
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertSessionHasErrors('name');
    }
    
    public function test_check_category_description_is_optional(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'updated test name',
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertRedirect(route('categories.index'))
        ->assertSessionHas('success', 'Category updated successfully');

        $this->assertDatabaseHas('categories', $updatedCategory);
    }

    public function test_check_category_description_must_be_at_most_1000_characters(): void
    {
        $category = Category::factory()->create();
        $updatedCategory = [
            'name' => 'updated test name',
            'description' => str_repeat('a', 1001)
        ];

        $response = $this->actingAs($this->user)->patch(route('categories.update', $category), $updatedCategory);

        $response
        ->assertStatus(302)
        ->assertSessionHasErrors('description');
    }
}
