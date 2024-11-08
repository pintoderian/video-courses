<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $youtubeUrls = [
            'https://www.youtube.com/watch?v=ekr2nIex040',
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'https://www.youtube.com/watch?v=2Vv-BfVoq4g',
            'https://www.youtube.com/watch?v=lTTajzrSkCw',
            'https://www.youtube.com/watch?v=a4na2opArGY',
            'https://www.youtube.com/watch?v=ovW7yRi1iJ8',
        ];

        for ($i = 1; $i <= 20; $i++) {
            // Seleccionar una categoría aleatoria
            $category = $categories->random();
            $title = "Course of " . $category->name . " #" . $i;
            $ageGroups = ['5-8', '9-13', '14-16', '16+'];
            $course = Course::create([
                'name' => $title,
                'slug' => Str::slug($title),
                'description' => 'Description of Course ' . $i . ' lala ' . strtolower($title),
                'image' => null,
                'age_group' => $ageGroups[array_rand($ageGroups)],
                'category_id' => $category->id,
            ]);

            // Crear entre 1 y 5 videos para cada curso
            $videoCount = rand(1, 5);
            for ($j = 1; $j <= $videoCount; $j++) {
                $videoTitle = "Video " . $j . " del " . $title;
                Video::create([
                    'name' => $videoTitle,
                    'slug' => Str::slug($videoTitle),
                    'description' => 'Description Video ' . $videoTitle . ' Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'url' => $youtubeUrls[array_rand($youtubeUrls)],
                    'course_id' => $course->id,
                    'is_block' => rand(0, 1),
                ]);
            }
        }
    }
}
