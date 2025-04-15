<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Create categories
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Garden',
            'Books',
            'Sports',
            'Toys'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => fake()->paragraph(),
                'meta_title' => $categoryName,
                'meta_description' => fake()->sentence(),
                'meta_keywords' => implode(', ', fake()->words(3)),
                'is_active' => true
            ]);
        }

        // Create products
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 5; $i++) {
                Product::create([
                    'name' => fake()->words(3, true),
                    'slug' => Str::slug(fake()->words(3, true)),
                    'description' => fake()->paragraphs(3, true),
                    'price' => fake()->randomFloat(2, 10, 1000),
                    'category_id' => $category->id,
                    'meta_title' => fake()->words(6, true),
                    'meta_description' => fake()->sentence(),
                    'meta_keywords' => implode(', ', fake()->words(3)),
                    'is_active' => true
                ]);
            }
        }

        // Create banners
        for ($i = 0; $i < 3; $i++) {
            Banner::create([
                'title' => fake()->words(3, true),
                'description' => fake()->sentence(),
                'image_path' => 'banners/banner-' . ($i + 1) . '.jpg',
                'link_url' => fake()->url(),
                'sort_order' => $i,
                'is_active' => true
            ]);
        }

        $this->call([
            AdminUserSeeder::class
        ]);
    }
}
