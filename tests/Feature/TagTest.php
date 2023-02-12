<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_tag_details()
    {
        $tag = Tag::factory()->create();

        $response = $this->getJson(route('api.v1.tags.show', $tag->slug))->json();

        $this->assertEquals($tag->name, $response['name']);
    }

    /** @test */
    public function api_get_tags()
    {
        Tag::factory(2)->create();

        $response = $this->getJson(route('api.v1.tags.index'))->json();

        $this->assertCount(2, $response);
    }

    /** @test */
    public function api_tags_accepts_limit()
    {
        Tag::factory(2)->create();

        $response = $this->getJson(route('api.v1.tags.index', ['limit' => 1]))->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function api_search_tags()
    {
        Tag::factory()->create(['name' => 'foobar']);
        Tag::factory()->create();

        $response = $this->getJson(route('api.v1.tags.index', ['search' => 'foo']))->json();

        $this->assertCount(1, $response);
    }
}
