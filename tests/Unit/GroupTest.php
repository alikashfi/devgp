<?php

namespace Tests\Unit;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_image_path()
    {
        $group = create(Group::class);

        $this->assertEquals(asset("images/group/{$group->getRawOriginal('image')}"), $group->image);

        $group->image = null;

        $this->assertEquals(asset("images/group/../default.jpg"), $group->image);
    }
}
