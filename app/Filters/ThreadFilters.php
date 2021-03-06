<?php

namespace App\Filters;
use App\User;
Use App\Filters\Filters;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popularity', 'unanswered'];

    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }

    public function popularity()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    public function unanswered()
    {
        $this->builder->doesntHave('replies');

    }
}
