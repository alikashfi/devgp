<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => str_replace('.', '', fake('fa_IR')->realText(rand(10, 20))),
            'slug'        => fake()->unique()->word() . ' ' . fake()->unique()->word(),
            'title'       => str_replace('.', '', fake('fa_IR')->realText(rand(15, 30))),
            'color'       => fake()->hexColor,
            'description' => fake()->randomElement([null, fake('fa_IR')->realText(rand(50, 100), 2)]),
        ];
    }
}
