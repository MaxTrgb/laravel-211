<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*Category::factory()->create([
            'name' => 'Category 1',
            'description' => 'Description 1'
        ]);

        Category::factory()->create([
            'name' => 'Category 2',
            'description' => 'Description 2'
        ]);*/

        Category::factory()->count(5)->hasProducts(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'name',
            'email' => 'mail@mail',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}
