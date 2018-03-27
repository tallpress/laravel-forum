<?php

namespace Tests\Feature;

use Tests\TestCase;
Use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
  use DatabaseMigrations;

  /** @test */
  public function a_guest_cannot_favorite_anything()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    $this->post('replies/1/favorites')
      ->assertRedirect('/login');
  }

  /** @test */
  public function an_auth_user_can_like_a_reply()
  {
    $this->signIn();
    $reply = create('App\Reply');
    $this->post('replies/' . $reply->id . '/favorites');
    $this->assertCount(1, $reply->favorites);
  }

  /** @test */
  public function a_auth_user_can_only_favorite_a_reply_once()
  {
    $this->signIn();
    $reply = create('App\Reply');
    $this->post('replies/' . $reply->id . '/favorites');
    $this->post('replies/' . $reply->id . '/favorites');
    $this->assertCount(1, $reply->favorites);
  }
}
