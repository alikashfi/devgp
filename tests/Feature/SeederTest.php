<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Tag;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertGreaterThan;

class SeederTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function seed_fake_groups_with_tags()
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('comments', 20);
        $this->assertDatabaseCount('tags', 20);
        $this->assertDatabaseCount('groups', 100);
        $this->assertLessThan(99, Group::whereHas('tags')->count());
    }
}
