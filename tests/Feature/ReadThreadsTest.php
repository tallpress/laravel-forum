<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_filter_by_channels()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', [
          'channel_id' => $channel->id
        ]);
        $threadNotInChannel = create('App\Thread', ['channel_id'=> $channel->id + 1]);
        $this->get("threads/{$channel->slug}")
          ->assertSee($threadInChannel->title)
          ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_user_name()
    {
      $this->signIn(create('App\User', ['name' => 'DTrump']));
      $users_id = auth()->id();
      $thread = create('App\Thread', [
        'user_id' => auth()->id()
      ]);
      $otherThread = create('App\Thread');

      $threadNotCreatedByUser = create('App\Thread');
      $this->get('threads/?by=DTrump')
        ->assertSee($thread->title)
        ->assertDontSee($otherThread->title);
    }
}
