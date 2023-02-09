<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_group_details()
    {
        $group = Group::factory()->create();

        $response = $this->getJson(route('api.v1.groups.show', $group->slug))->json();

        $this->assertEquals($group->name, $response['name']);
    }

    /** @test */
    public function get_list_of_groups()
    {
        Group::factory(2)->create();

        $response = $this->getJson(route('api.v1.groups.index'))->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    public function groups_return_with_their_categories()
    {
        $categories = Category::factory()->count(2)->create();
        Group::factory()->create()->categories()->sync($categories->pluck('id')->toArray());

        $response = $this->getJson(route('api.v1.groups.index'))->json();

        $this->assertCount(2, $response['data'][0]['categories']);
    }

    /** @test */
    public function filter_groups_by_category_slug()
    {
        Category::factory(2)->create();
        Group::factory()->create()->categories()->sync($cateogryId = 1);
        Group::factory()->create()->categories()->sync($categoryId = 2);

        tap(Category::first(), function ($category) {
            $response = $this->getJson(route('api.v1.groups.index', ['category' => $category->slug]))->json();
            $this->assertCount(1, $response['data']);
        });
    }

    /** @test */
    public function search_groups()
    {
        Group::factory()->create(['name' => 'foobar']);
        Group::factory()->create();

        $response = $this->getJson(route('api.v1.groups.index', ['search' => 'foobar']))->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function sort_groups()
    {
        Group::factory()->create(['members' => 100]);
        Group::factory()->create(['members' => 200]);

        $response = $this->getJson(route('api.v1.groups.index', ['sort' => 'members,desc']))->json();
        $this->assertEquals(200, $response['data'][0]['members']);
    }
}
