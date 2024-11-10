<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::updateOrCreate([
            'name'      => 'Test Brand',
            'slug'     => 'test-brand',
            'description'     => 'Test Brand Description',
            'featured'     => true,
        ]);
    }
}
