<?php

namespace Tests\Feature;

use App\Models\Tag;
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
    public function groups_return_with_their_tags()
    {
        $tags = Tag::factory(2)->create();
        Group::factory()->create()->tags()->sync($tags->pluck('id')->toArray());

        $response = $this->getJson(route('api.v1.groups.index'))->json();

        $this->assertCount(2, $response['data'][0]['tags']);
    }

    /** @test */
    public function filter_groups_by_tag_slug()
    {
        Tag::factory(2)->create();
        Group::factory()->create()->tags()->sync($tagId = 1);
        Group::factory()->create()->tags()->sync($tagId = 2);

        tap(Tag::first(), function ($tag) {
            $response = $this->getJson(route('api.v1.groups.index', ['tag' => $tag->slug]))->json();
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
        $first = Group::factory()->withTag()->create();
        $second = tap(Group::factory()->create(), fn ($g) => $g->tags()->sync($first->tags()->pluck('tags.id')->toArray()));
        $other = Group::factory()->withTag()->create();

        $response = $this->getJson(route('api.v1.groups.related', $first->slug))->json();

        $this->assertEquals([$second->name], array_column($response, 'name'));
    }

    /** @test */
    public function it_generates_image_path()
    {
        $group = Group::factory()->create();

        $this->assertEquals(asset("images/group/{$group->getRawOriginal('image')}"), $group->image);

        $group->image = null;

        $this->assertEquals(asset("images/group/../default.jpg"), $group->image);
    }
}
