<?php

namespace Tests\Unit;

use App\Category;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsControllerTest extends TestCase
{
    /**
     * @test
     */
    public function i_can_get_all_products()
    {
        $this->json('GET', '/api/product')
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id',
                    'name',
                    'description',
                    'image',
                    'category_id',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /**
     * @test
     */
    public function i_can_save_product()
    {
        $category = Category::first();
        $data = [
            'name' => 'test',
            'description' => 'description_test',
            'category' => $category->id
        ];
        $this->json('POST', '/api/product', $data)
            ->assertStatus(200)
            ->assertJsonFragment([
                'created' => true,
            ]);
    }

    /**
     * @test
     */
    public function i_can_see_product_by_id()
    {
        $product = Product::first();
        $this->json('GET', '/api/product/' . $product->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'image',
                'category_id',
                'created_at',
                'updated_at'
            ]);
    }

    /**
     * @test
     */
    public function i_can_update_product()
    {
        $product = Product::first();
        $data = [
            'name' => 'test_update',
            'description' => 'description_test_update',
            'category' => $product->category_id
        ];
        $this->json('PUT', '/api/product/' . $product->id, $data)
            ->assertStatus(200)
            ->assertJsonFragment([
                'updated' => true
            ]);
    }

    /**
     * @test
     */
    public function i_can_destroy_product()
    {
        $product = Product::first();
        $this->json('DELETE', '/api/product/' . $product->id)
            ->assertStatus(200)
            ->assertJsonFragment([
                'deleted' => true
            ]);
    }

    /**
     * @test
     */
    public function i_can_get_product_by_cat()
    {
        $category = Category::first();
        $this->json('GET', '/api/products/cat/' . $category->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id',
                    'name',
                    'description',
                    'image',
                    'category_id',
                    'created_at',
                    'updated_at'
                ]
            ]);

    }
}
