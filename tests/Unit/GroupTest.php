<?php

namespace Tests\Unit;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Request;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_image_path_even_when_null()
    {
        $group = create(Group::class);

        $this->assertEquals(asset("images/group/{$group->getRawOriginal('image')}"), $group->image);

        $group->image = null;

        $this->assertEquals(asset("images/group/../default.jpg"), $group->image);
    }

    /** @test */
    public function it_can_handle_image_path_with_test_storage_and_with_asset_url()
    {
        $group = create(Group::class, ['image' => 'one.jpg']);

        \URL::forceRootUrl('https://foo.com');
        config(['filesystems.default' => 'test_images']);

        $this->assertEquals('https://foo.com/test_images/group/one.jpg', $group->image);
    }
}
