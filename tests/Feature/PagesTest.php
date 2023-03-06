<?php

namespace Tests\Feature;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sitemap()
    {
        Group::factory()->withTag()->create();

        $this->get(route('sitemap'))
            ->assertSee(Group::first()->slug);
            // ->assertSee(Tag::first()->slug); // v2 front-end
    }
}
