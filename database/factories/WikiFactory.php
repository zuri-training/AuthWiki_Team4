<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\wiki>
 */
class wikiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 11, //rand(1, 10),
            'type' => 'forum',
            'stack' => 'PHP',
            'file_dir' => '',
            'title' => fake()->realTextBetween(10, 25, 1),
            'content' => fake()->realText()
        ];
    }
}
