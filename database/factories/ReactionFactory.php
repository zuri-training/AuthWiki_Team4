<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reaction>
 */
class reactionFactory extends Factory
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
            'wiki_id' => rand(1, 10),
            // 'comment_id' => rand(1, 10),
            'rating' => 0 //rand(1, 5)
        ];
    }
}
