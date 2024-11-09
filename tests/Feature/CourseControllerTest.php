<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_list_courses()
    {
        $response = $this->getJson('/api/v1/courses');

        $response = $this->getJson('/api/v1/courses');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'image',
                        'age_group',
                        'description',
                        'category_id',
                        'created_at',
                        'updated_at',
                        'category' => [
                            'id',
                            'name',
                            'slug',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }

    public function test_view_videos_for_a_course()
    {
        $response = $this->getJson("/api/v1/courses/1/videos");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'slug',
                    'course_id',
                    'url',
                    'description',
                    'is_block',
                    'created_at',
                    'updated_at',
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    public function test_register_user_in_course()
    {
        $user = User::find(1);
        $course = Course::find(1);

        $this->actingAs($user)
            ->postJson('/api/v1/courses/register', [
                'course_id' => $course->id,
                'user_id' => $user->id
            ]);

        $this->assertDatabaseHas('user_courses', [
            'user_id' => $user->id,
            'course_id' => $course->id
        ]);
    }
}
