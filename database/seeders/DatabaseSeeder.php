<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Category::factory()->create([
            'name' => 'tidak ada',
        ]);
        Category::factory()->create([
            'name' => 'Foods',
        ]);
        Category::factory()->create([
            'name' => 'Groceries',
        ]);
        Category::factory()->create([
            'name' => 'Transportation',
        ]);
    }
};