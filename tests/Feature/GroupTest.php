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
}
