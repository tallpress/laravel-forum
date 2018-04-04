<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_auth_user_can_remove_a_reply()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['user_id' => auth()->id(), 'thread_id' => $thread->id]);
        $response = $this->json('DELETE', $reply->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    // /** @test */
    // public function a_un_auth_user_cannot_delete_a_reply()
    // {
    //     $this->withoutExceptionHandling();
    //     $reply = create('App\Reply');
    //
    //     $this->delete("replies/{$reply->id}")
    //         ->assertRedirect('login');
    // }

    /** @test */
    public function a_auth_user_can_Delete_a_reply()
    {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['user_id' => auth()->id(), 'thread_id' => $thread->id]);
        $this->json('DELETE', $reply->path());
        $this->assertDatabaseMissing('replies', ['body' => $reply->body]);
    }
}
