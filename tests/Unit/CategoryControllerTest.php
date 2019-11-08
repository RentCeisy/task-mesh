<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    /**
     * @test
     */
    public function i_see_category_with_relationship()
    {
        $this->getJson('/api/category')
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id', 'parent_id', 'lft', 'rgt', 'depth', 'value', 'created_at', 'updated_at',
                    'children' => []
                ]
            ]);
    }

    /**
     * @test
     */
    public function i_can_delete_category()
    {
        $category = Category::first();
        $this->json('DELETE', '/api/category/' . $category->id)
        ->assertStatus(200)
        ->assertJsonFragment([
            'deleted' => true
        ]);
    }
}
