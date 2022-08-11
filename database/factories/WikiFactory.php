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
            'user_id' => 1, //rand(1, 10),
            'type' => 'wiki',
            'category_id' => rand(1, 5),
            'file_id' => null,
            'title' => fake()->realTextBetween(10, 25, 1),
            'description' => fake()->text(),
            'content' => fake()->realText()
        ];
    }
}
