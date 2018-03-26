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

}
