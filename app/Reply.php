<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use Favoritable, RecordsActivity;

  protected $guarded = [];
  protected $with =['owner', 'favorites'];

  // protected $appends = ['favoritesCount', 'isFavorited'];

    public static function boot()
    {
      parent::boot();

      static::deleting(function($reply) {
          $reply->thread->decrement('replies_count');
          foreach ($reply->favorites as $favorite)
          $favorite->delete();

      });

      static::created(function($reply) {
          $reply->thread->increment('replies_count');
      });

    }

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function thread()
  {
      return $this->belongsTo(Thread::class);
  }

  public function path()
  {
      return $this->thread->path() .  "#reply-{$this->id}";
  }
}
