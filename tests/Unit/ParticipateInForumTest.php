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

       TestCase::signIn();

       $thread = factory('App\Thread')->create();
       $reply = factory('App\Reply')->make();
       $request =  $reply->toArray();

       $response = $this->json(
         'POST',
         "threads/{$thread->channel}/{$thread->id}/replies",
         $request
       );
       $this->get($thread->path())
        ->assertSee($reply->body);

     }
}
