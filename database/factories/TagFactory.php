<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'        => str_replace('.', '', fake('fa_IR')->unique()->realText(rand(10, 20))),
            'title'       => str_replace('.', '', fake('fa_IR')->realText(rand(15, 30))),
            'color'       => fake()->hexColor,
            'description' => fake()->randomElement([null, fake('fa_IR')->realText(rand(50, 100), 2)]),
        ];
    }
}
