<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
      parent::setUp();
      $this->thread = factory('App\Thread')->create();
    }

    /** @test **/
    public function a_user_can_browse_threads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_view_a_single_thread()
    {
      $response = $this->get('/threads/' . $this->thread->id);
      $response->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_read_a_threads_replies()
    {
      echo app('env'); // IN TESTING ENVIRONMENT
      echo ("##################################################################");
      $reply = factory('App\Reply')
        ->create(['thread_id' => $this->thread->id]);
      $this->get('/threads/' . $this->thread->id)
        ->assertSee($reply->body);
    }
}
