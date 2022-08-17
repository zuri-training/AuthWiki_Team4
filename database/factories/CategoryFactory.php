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
        $category = ['django', 'javascript', 'python'];
        $randCategory = $category[rand(1, (count($category)-1))];
        return [
            'type' => 'wiki',
            'name' => $randCategory,
            'icon' => "images/icon/{$randCategory}.svg",
            'description' => fake()->text()
        ];
    }
}
