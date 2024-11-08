<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Development",
            "Business",
            "Finance & Accounting",
            "IT & Software",
            "Office Productivity",
            "Personal Development",
            "Design",
            "Marketing",
            "Lifestyle",
            "Photography",
            "Health & Fitness",
            "Music",
            "Teaching & Academics"
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category, 'slug' => Str::slug($category)]);
        }
    }
}
