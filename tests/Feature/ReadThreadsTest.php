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
}
