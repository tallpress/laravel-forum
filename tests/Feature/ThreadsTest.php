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
      $this->thread = create('App\Thread');
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
      $response = $this->get($this->thread->path());
      $response->assertSee($this->thread->title);
    }

    /** @test **/
    public function a_user_can_read_a_threads_replies()
    {
      $reply = factory('App\Reply')
        ->create(['thread_id' => $this->thread->id]);
      $this->get($this->thread->path())
        ->assertSee($reply->body);
    }

    /** @test **/
    public function a_thread_can_make_a_string_a_path()
    {
      $thread = make('App\Thread');
      $this->assertEquals($thread->path(), "/threads/{$thread->channel->slug}/{$thread->id}");
    }
}
