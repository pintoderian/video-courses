<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgressControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_video_progress()
    {
        $user = User::find(2);
        $video = Video::find(1);
        $course = Course::find(1);

        $user->courses()->attach($course);

        $response = $this->actingAs($user)
            ->postJson("/api/v1/progress/{$course->id}/update", [
                'user_id' => $user->id,
                'video_id' => $video->id,
                'is_completed' => true
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Video marked as completed!',
                'is_completed' => true
            ]);

        $this->assertDatabaseHas('user_video_progress', [
            'user_id' => $user->id,
            'video_id' => $video->id,
            'course_id' => $course->id,
            'is_completed' => true
        ]);
    }
}
