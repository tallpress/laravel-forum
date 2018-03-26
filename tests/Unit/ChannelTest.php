<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @test
     */
    public function a_channel_has_theads()
    {
        $channel = create('App\Channel', [
          'id' => 34,
          'name' => "perferendis",
          'slug' => "perferendis",
          'created_at' => "2018-03-26 08:58:31",
          'updated_at' => "2018-03-26 08:58:31"
        ]);

        $thread = create('App\Thread', [
           'id' => 2,
           'user_id' => 2,
           'channel_id' => 34,
           'title' => "Sit dolor error nam a vel.",
           'body' => "Expedita natus exercitationem placeat minima architecto nostrum vero. Laborum consectetur eaque qui. Hic reprehenderit dolorum non suscipit. Sit impedit assumenda officia eum voluptas consequatur nostrum.",
           'created_at' => "2018-03-26 08:58:31",
           'updated_at' => "2018-03-26 08:58:31"
        ]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}
