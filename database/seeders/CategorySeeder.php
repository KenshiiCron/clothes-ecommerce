<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate([
            'name'      => 'Test Category',
            'slug'     => 'test-category',
            'description'     => 'Test Category Description',
            'featured'     => true,
        ]);
    }
}
