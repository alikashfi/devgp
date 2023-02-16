<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GroupApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_group_details()
    {
        $group = create(Group::class);

        $response = $this->getJsonRoute('api.v1.groups.show', $group->slug)->json();

        $this->assertEquals($group->name, $response['name']);
    }

    /** @test */
    public function group_views_increases_per_visitor()
    {
        $group = create(Group::class, ['views' => 0, 'daily_views' => 0]);

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
        create(Group::class, count: 2);

        $response = $this->getJsonRoute('api.v1.groups.index')->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    public function groups_return_with_their_tags()
    {
        $tags = create(Tag::class, count: 2);
        create(Group::class)->tags()->sync($tags->pluck('id')->toArray());

        $response = $this->getJsonRoute('api.v1.groups.index')->json();

        $this->assertCount(2, $response['data'][0]['tags']);
    }

    /** @test */
    public function a_returned_group_only_represents_specific_fields()
    {
        $group = create(Group::class);

        $response = $this->getJsonRoute('api.v1.groups.index', $group->slug)->json();

        $this->assertArrayHasKey('views', $response['data'][0]);
        $this->assertArrayNotHasKey('daily_views', $response['data'][0]);
    }

    /** @test */
    public function filter_groups_by_tag_slug()
    {
        create(Tag::class, count: 2);
        create(Group::class)->tags()->sync($tagId = 1);
        create(Group::class)->tags()->sync($tagId = 2);

        tap(Tag::first(), function ($tag) {
            $response = $this->getJsonRoute('api.v1.groups.index', ['tag' => $tag->slug])->json();
            $this->assertCount(1, $response['data']);
        });
    }

    /** @test */
    public function filter_search_groups()
    {
        create(Group::class, ['name' => 'foobar']);
        create(Group::class);

        $response = $this->getJsonRoute('api.v1.groups.index', ['search' => 'foo'])->json();
        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function filter_sort_groups()
    {
        create(Group::class, ['members' => 100]);
        create(Group::class, ['members' => 200]);

        $response = $this->getJsonRoute('api.v1.groups.index', ['sort' => 'members,desc'])->json();
        $this->assertEquals(200, $response['data'][0]['members']);
    }

    /** @test */
    public function api_related_groups()
    {
        $first = Group::factory()->withTag()->create();
        $second = tap(create(Group::class), fn($g) => $g->tags()->sync($first->tags()->pluck('tags.id')->toArray()));
        $other = Group::factory()->withTag()->create();

        $response = $this->getJsonRoute('api.v1.groups.related', $first->slug)->json();

        $this->assertEquals([$second->name], array_column($response, 'name'));
    }

    /** @test */
    public function api_store_new_group_minimum_fields()
    {
        $group = [
            "name" => 'گروه لاراول',
            "link" => 'https://t.me/laravel',
        ];

        $response = $this->postJsonRoute('api.v1.groups.store', data: $group)->assertCreated()->json();

        $this->assertEquals($group['name'], $response['name']);
        $this->assertDatabaseHas('groups', $group);
    }

    /** @test */
    public function api_store_new_group_with_image_and_tags()
    {
        Storage::fake();

        $tags = create(Tag::class, count: 2);

        $group = [
            "name"  => 'گروه لاراول',
            "slug"  => 'laravel-group',
            "link"  => 'https://t.me/laravel',
            "tags"  => $tags->pluck('slug')->toArray(),
            "image" => UploadedFile::fake()->image('cover.jpg'),
        ];

        $this->postJsonRoute('api.v1.groups.store', data: $group)->assertSuccessful();

        tap(Group::first(), function ($group) {
            $this->assertDatabaseCount('groups', 1);
            $this->assertCount(2, $group->tags);
            Storage::assertExists("group/" . $group->getRawOriginal('image'));
        });
    }

    /** @test */
    public function api_store_new_group_validation_errors()
    {
        $group = [
            "name"  => null,
            "slug"  => 'فارسی',
            "link"  => 'not-url',
            "tags"  => 'string',
            "image" => UploadedFile::fake()->image('cover.jpg')->size(4096),
        ];

        $this->postJsonRoute('api.v1.groups.store', data: $group)->assertJsonValidationErrors(array_keys($group));
    }
}
