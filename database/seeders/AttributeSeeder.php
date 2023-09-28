<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Space',
            ],
            [
                'name' => 'Color',
            ],
        ];

        foreach ($attributes as $index => $attribute) {
            Attribute::create($attribute);
        }
    }
}
