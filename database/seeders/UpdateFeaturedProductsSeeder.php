<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateFeaturedProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mark first 8 active products as featured
        Product::where('is_active', true)
            ->limit(8)
            ->update(['is_featured' => true]);
    }
}
