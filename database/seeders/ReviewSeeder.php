<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = Product::all(); // Get all products

        foreach ($products as $product) {
            // Add 3 reviews to each product
            for ($i = 0; $i < 3; $i++) {
                Review::create([
                    'product_id' => $product->id, // Associate the review with the product
                    'name' => $faker->name,        // Faker-generated name for review author
                    'review' => $faker->sentence(10), // Faker-generated review text
                    'created_at' => now(),         // Current timestamp
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
