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
      $user = create('App\User');
      $this->be($user); //authenticate the user

      $thread = make('App\Thread');

      $this->post('/threads', $thread->toArray());

      $this->get('/threads/'.$thread->id)
       ->assertSee($thread->title)
       ->assertSee($thread->body);
    }

    /** @test */
    public function non_auth_users_cannot_see_create_thread_page()
    {
      $this->expectException('Illuminate\Auth\AuthenticationException');
      $this->get('/threads/create');
    }
}
