<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    public function definition()
    {
        return [
            'name'         => 'گروه ' . str_replace('.', '', fake('fa_IR')->realText(rand(20, 40))),
            'image'        => fake()->randomElement(['one', 'two', 'three']) . '.jpg',
            'description'  => fake()->randomElement([null, fake('fa_IR')->realText(rand(50, 300), 2)]),
            'link'         => \Str::limit(fake()->unique()->url(), 100, ''),
            'support_link' => \Str::limit(fake()->optional(20)->url(), 100, ''),
            'members'      => fake()->randomElement([null, rand(100, 20000)]),
            'views'        => rand(100, 10000),
            'daily_views'  => rand(0, 100),
        ];
    }

    public function withTag()
    {
        return $this->afterCreating(function (Group $group) {
            Tag::factory()->create()->groups()->sync($group->id);
        });
    }
}
