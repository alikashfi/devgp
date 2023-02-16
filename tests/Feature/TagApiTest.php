<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_tag_details()
    {
        $tag = create(Tag::class);

        $response = $this->getJsonRoute('api.v1.tags.show', $tag->slug)->json();

        $this->assertEquals($tag->name, $response['name']);
    }

    /** @test */
    public function a_returned_tag_only_represents_specific_fields()
    {
        $tag = create(Tag::class);

        $response = $this->getJsonRoute('api.v1.tags.index', $tag->slug)->json();

        $this->assertArrayHasKey('name', $response[0]);
        $this->assertArrayNotHasKey('id', $response[0]);
    }

    /** @test */
    public function api_get_tags()
    {
        create(Tag::class, count: 2);

        $response = $this->getJsonRoute('api.v1.tags.index')->json();

        $this->assertCount(2, $response);
    }

    /** @test */
    public function api_tags_accepts_limit()
    {
        create(Tag::class, count: 2);

        $response = $this->getJsonRoute('api.v1.tags.index', ['limit' => 1])->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function api_search_tags()
    {
        create(Tag::class, ['name' => 'foobar']);
        create(Tag::class);

        $response = $this->getJsonRoute('api.v1.tags.index', ['search' => 'foo'])->json();

        $this->assertCount(1, $response);
    }
}
