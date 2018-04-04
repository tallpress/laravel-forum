<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{

  use DatabaseMigrations;
  /**
   * A basic test example.
   *
   * @test
   */

   public function a_unauth_user_cannot_create_a_thread()
   {
     $this->expectException('Illuminate\Auth\AuthenticationException');
     $thread = make('App\Thread');
     $this->post('/threads', $thread->toArray());
   }

  /** @test */
  public function a_aiuth_user_can_create_a_thread()
  {
    $this->signIn();
    $thread = make('App\Thread');
    $response = $this->post('/threads', $thread->toArray());
    $this->get($response->headers->get('Location'))
        ->assertSee($thread->title)
        ->assertSee($thread->body);
  }

  /** @test */
  public function non_auth_users_cannot_see_create_thread_page()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $this->get('/threads/create');
  }

  /** @test */
  public function a_new_thread_requires_a_title()
  {
    $this->expectException('Illuminate\Validation\ValidationException');
    $this->publishThread(['title' => null]);
    $this->post('/threads', $thread->toArray());
  }

  /** @test */
  public function a_new_thread_requires_a_body()
  {
    $this->expectException('Illuminate\Validation\ValidationException');
    $this->publishThread(['body' => null]);
    $this->post('/threads', $thread->toArray());
  }

  /** @test */
  public function a_new_thread_requires_a_channel_id()
  {
    factory('App\Channel', 2)->create();
    $this->expectException('Illuminate\Validation\ValidationException');

    $this->publishThread(['channel_id' => 99]);
    $this->post('/threads', $thread->toArray());

  }

  /** @test */
  public function a_thread_can_be_deleted_by_its_owner()
  {
    $this->signIn();
    $thread = create('App\Thread', ['user_id' => auth()->id()]);
    $response = $this->json('DELETE', $thread->path());
    $response->assertStatus(204);
    $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
    $this->assertDatabaseMissing('activities', [
        'subject_id' => $thread->id,
        'subject_type' => get_class($thread)
    ]);
  }

  /** @test */
  public function when_a_thread_is_deleted_its_replies_are_deleted_too()
  {
    $this->signIn();
    $thread = create('App\Thread', ['user_id' => auth()->id()]);
    $reply = create('App\Reply', ['thread_id' => $thread->id ]);
    $response = $this->json('DELETE', $thread->path());
    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

    $this->assertDatabaseMissing('activities', [
        'subject_id' => $reply->id,
        'subject_type' => get_class($reply)
    ]);
  }


  public function publishThread($overrides)
  {
    $this->signIn();
    $thread = make('App\Thread', $overrides);
    return $this->post('/threads', $thread->toArray());
  }
}
