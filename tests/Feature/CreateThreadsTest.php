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
       $thread = factory('App\Thread')->make();
       $this->post('/threads', $thread->toArray());
     }


    public function a_aiuth_user_can_create_a_thread()
    {
      $user = factory('App\User')->create();
      $this->be($user); //authenticate the user

      $thread = factory('App\Thread')->make();

      $this->post('/threads', $thread->toArray());

      $this->get('/threads/'.$thread->id)
       ->assertSee($thread->title)
       ->assertSee($thread->body);

    }
}
