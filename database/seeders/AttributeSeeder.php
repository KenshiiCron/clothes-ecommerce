<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attribute::updateOrCreate([
            'name'      => 'size',
        ]);

        Attribute::updateOrCreate([
            'name'      => 'color',
        ]);

        Attribute::updateOrCreate([
            'name'      => 'storage',
        ]);
    }
}
