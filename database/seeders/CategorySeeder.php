<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'أدوات الطهي', 'slug' => 'cooking-tools'],
            ['name' => 'أدوات المائدة', 'slug' => 'tableware'],
            ['name' => 'أجهزة المطبخ', 'slug' => 'kitchen-appliances'],
            ['name' => 'تخزين وتنظيم', 'slug' => 'storage-organization'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
