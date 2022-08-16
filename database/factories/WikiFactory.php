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
            'user_id' => 1,
            'type' => 'wiki',
            'category_id' => rand(1, 10),
            'title' => fake()->realTextBetween(10, 250, 1),
            'overview' => fake()->randomHtml(4, 5),
            'contents' => fake()->randomHtml(5, 10)
        ];
    }
}
