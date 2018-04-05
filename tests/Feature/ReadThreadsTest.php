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

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
      $threadWithNoReplies = create('App\Thread');

      $threadWithTwoReplies = create('App\Thread');
      $repliesForThreadWithTwoReplies = create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

      $theadWithMostRepleis = create('App\Thread');
      $repliesForThreadWithMostReplies = create('App\Reply', ['thread_id' => $theadWithMostRepleis->id] ,3);

      $response = $this->getJson('threads?popularity=1')->json();

      $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }

    /** @test */
    public function a_user_can_search_by_unanswered_threads()
    {
        $thread = create('App\Thread');
        $thread2 = create('App\Thread');
        create('App\Reply', ['thread_id' => $thread2->id]);

        $response = $this->getJson('/threads?unanswered=1')->json();
        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_filter_threads_by_unansered_threads_visual()
    {
        $this->signIn();
        $threadWithReply = create('App\Thread');
        $reply = create('App\Reply', ['body' => 'BIG_FUCK_OFF_TITLE', 'thread_id' => $threadWithReply->id]);
        $threadWithoutReply = create('App\Thread');
        $response = $this->getJson('/threads?unanswered=1')->json();
        // $this->get('/threads?unanswered=1')
        //     ->assertSee($threadWithReply->title)
        //     ->assertSee($threadWithReply->body)
        //     ->assertDontSee($threadWithoutReply->title)
        //     ->assertDontSee($threadWithoutReply->body);
        $this->assertCount(1, $response);
    }
}
