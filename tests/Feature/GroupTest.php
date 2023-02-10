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
    public function api_group_details()
    {
        $group = Group::factory()->create();

        $response = $this->getJson(route('api.v1.groups.show', $group->slug))->json();

        $this->assertEquals($group->name, $response['name']);
    }

    /** @test */
    public function group_views_increases_per_visitor()
    {
        $group = Group::factory()->create(['views' => 0, 'daily_views' => 0]);

        $this->get(route('api.v1.groups.show', $group->slug));
        $this->get(route('api.v1.groups.show', $group->slug));

        $this->assertDatabaseHas('groups', ['views' => 1, 'daily_views' => 1]);

        $this->withServerVariables(['REMOTE_ADDR' => '2.2.2.2']);
        $this->get(route('api.v1.groups.show', $group->slug));

        $this->assertDatabaseHas('groups', ['views' => 2, 'daily_views' => 2]);
    }

    /** @test */
    public function api_groups_list()
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
    public function filter_search_groups()
    {
        Group::factory()->create(['name' => 'foobar']);
        Group::factory()->create();

        $response = $this->getJson(route('api.v1.groups.index', ['search' => 'foobar']))->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function filter_sort_groups()
    {
        Group::factory()->create(['members' => 100]);
        Group::factory()->create(['members' => 200]);

        $response = $this->getJson(route('api.v1.groups.index', ['sort' => 'members,desc']))->json();
        $this->assertEquals(200, $response['data'][0]['members']);
    }

    /** @test */
    public function api_related_groups()
    {
        $first = Group::factory()->withCategory()->create();
        $second = tap(Group::factory()->create(), fn ($g) => $g->categories()->sync($first->categories()->pluck('categories.id')->toArray()));
        $other = Group::factory()->withCategory()->create();

        $response = $this->getJson(route('api.v1.groups.related', $first->slug))->json();

        $this->assertEquals([$second->name], array_column($response, 'name'));
    }
}
