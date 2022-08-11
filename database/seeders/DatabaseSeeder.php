<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(7)->create();
        \App\Models\Glossary::factory(10)->create();
        \App\Models\Wiki::factory(10)->create();
        \App\Models\Comment::factory(50)->create();
    }
}
