<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => 'گروه ' . str_replace('.', '', fake('fa_IR')->realText(rand(20, 40))),
            'image'       => fake()->randomElement(['one', 'two', 'three']) . '.jpg',
            'description' => fake()->randomElement([null, fake('fa_IR')->realText(rand(50, 200), 2)]),
            'address'     => fake()->url(),
            'members'     => fake()->randomElement([null, rand(100, 20000)]),
            'views'       => rand(100, 10000),
            'daily_views' => rand(0, 100),
        ];
    }
}
