<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ['Action RPG', 'Sports', 'Battle Royale'];

        foreach ($categories as $categoryName) {
            Category::factory()->create([
                'name' => $categoryName,
            ]);
        }

        // Category::factory(3)->create();

        Product::factory(10)->create();
    }
}
