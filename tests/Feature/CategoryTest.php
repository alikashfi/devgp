<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_category_details()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('api.v1.categories.show', $category->slug))->json();

        $this->assertEquals($category->name, $response['name']);
    }
}
