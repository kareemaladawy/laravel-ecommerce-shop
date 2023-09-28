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
        $categories = [
            [
                'name' => 'Mobile Phones',
            ],
            [
                'name' => 'Tablets',
            ],
            [
                'name' => 'Laptops',
            ],
        ];

        foreach($categories as $index => $category){
            Category::create($category);
        }
    }
}
