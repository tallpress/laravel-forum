<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubToThreadsTest extends TestCase
{
    use DatabaseMigrations;
    public function test_a_user_can_sub_to_thread()
    {
        $this->signIn();
        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Bet you are glad you subbed to this'
        ]);
        // auth()->user()->notfications
        // $this->assertCount(1, $thread->subsrtiptions);
    }
}
