<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_post_comment_on_video()
    {
        $user = User::find(2);
        $video = Video::find(1);

        $this->actingAs($user)
            ->postJson("/api/v1/comments/{$video->id}", [
                'user_id' => $user->id,
                'comment' => 'This is a test comment.'
            ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'video_id' => $video->id,
            'comment' => 'This is a test comment.'
        ]);
    }
}
