<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_like_video()
    {
        $user = User::find(2);
        $video = Video::find(1);

        $this->actingAs($user)
            ->postJson("/api/v1/videos/{$video->id}/like", [
                'user_id' => $user->id,
            ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'video_id' => $video->id
        ]);
    }
}
