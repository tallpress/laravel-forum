<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
      parent::setUp();
      $this->thread = create('App\Thread');
    }

    /** @test*/
    public function a_thread_has_a_owner()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test*/
    public function a_thread_can_add_a_reply()
    {
      $this->thread->addReply([
        'body' => 'testing',
        'user_id' => 1
      ]);

      $this->assertCount(1, $this->thread->replies);
    }

    /** @test*/
    public function a_thread_belongs_to_a_channel()
    {
      $thread = create('App\Thread');
      $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /** @test */
    public function a_thread_can_be_subbed()
    {
        $thread = create('App\Thread');
        $thread->subscribe($userId = 1);
        $this->assertEquals(1, $thread->subscriptions()->where('user_id', $userId)->count());
    }

    /** @test */
    public function a_thread_can_be_unsubbed()
    {
        $thread = create('App\Thread');
        $thread->subscribe($userId = 1);
        $thread->unsubscribe($userId);
        $this->assertEquals(0, $thread->subscriptions()->count());
    }

}
