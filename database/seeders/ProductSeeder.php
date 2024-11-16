<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::updateOrCreate([
            'name'      => 'Test Product',
            'slug'     => 'test-product',
            'description'     => 'Test Product Description',
            'brand_id'     => 1,
        ]);

        ProductCategory::updateOrCreate([
            'product_id'     => 1,
            'category_id'     => 1,
        ]);
    }
}
