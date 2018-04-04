<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];
    protected $with = ['subject'];

    public function subject()
    {
        return $this->morphTo();
    }

    public static function feed(User $user, $take = 50)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->take($take)->get()
            ->groupBy(function ($activity) {
                    return $activity->created_at->format('Y-m-d');
                }
            );
    }
}
