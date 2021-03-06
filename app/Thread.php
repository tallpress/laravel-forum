<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($thread){
            $thread->replies()->each(function($reply) {
                $reply->delete();
            });
        });
  }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function addReply($reply)
    {
        $this->replies()->create($reply)
            ->withCount('favorites');
    }


    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }


    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe(int $userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function unsubscribe(int $userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }
}
