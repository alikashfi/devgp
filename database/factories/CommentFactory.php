<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake('fa_IR')->name,
            'email' => fake('fa_IR')->email,
            'message' => fake('fa_IR')->realText(rand(20, 100), 2),
        ];
    }

    public function withGroup()
    {
        $this->state(function () {
            return [
                'group_id' => Group::factory()->create()->id
            ];
        });
    }
}
