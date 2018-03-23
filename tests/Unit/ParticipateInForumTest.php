<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
     public function a_user_can_contribute_a_reply_to_a_thread_auth_user()
     {
       $user = factory('App\User')->create();
       $this->be($user); //authenticate the user

       $thread = factory('App\Thread')->create();
       $reply = factory('App\Reply')->make();
       $request =  $reply->toArray();

       $response = $this->json(
         'POST',
         '/threads/' . $thread->id . '/replies',
         $request
       );
       $this->get('/threads/'.$thread->id)
        ->assertSee($reply->body);

     }
}
