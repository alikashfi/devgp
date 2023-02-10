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
}
