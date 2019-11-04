<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCategoryController()
    {
        $response = $this->action('GET', 'CategoryController@getRelationshipAll');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
