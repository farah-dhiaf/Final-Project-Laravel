<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Category::create([
            'name' => 'tidak ada',
        ]);
        Category::create([
            'name' => 'Foods',
        ]);
        Category::create([
            'name' => 'Groceries',
        ]);
        Category::create([
            'name' => 'Transportation',
        ]);

        User::factory()->count(10)->create();
        Transaction::factory()->count(100)->create();
    }
};