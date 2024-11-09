<?php

namespace Database\Seeders;

use App\Models\Product;
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
            'category_id'     => 1,
            'brand_id'     => 1,
        ]);
    }
}
