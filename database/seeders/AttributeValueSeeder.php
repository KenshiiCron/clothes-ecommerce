<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeValue::updateOrCreate([
            'attribute_id' => 1,
            'value' => 'm',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 1,
            'value' => 'l',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 2,
            'value' => 'red',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 2,
            'value' => 'blue',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 2,
            'value' => 'green',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 3,
            'value' => '64',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 3,
            'value' => '128',
        ]);

        AttributeValue::updateOrCreate([
            'attribute_id' => 3,
            'value' => '256',
        ]);
    }
}
