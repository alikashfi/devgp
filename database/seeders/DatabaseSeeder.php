<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::factory(100)->create();
        $tags = Tag::factory(20)->create();
        $tagIds = $tags->pluck('id')->toArray();

        // 10% of groups get no tags. while others will have 1 to 5 tags.
        $groups->each(function ($group) use ($tagIds) {
            $group->tags()->sync(
                fake()->optional(90)->randomElements($tagIds, rand(1, 5))
            );
        });
    }
}
