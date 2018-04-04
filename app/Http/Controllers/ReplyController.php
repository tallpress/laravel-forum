<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;

class ReplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function store($channelId, Thread $thread)
  {
    $this->validate(request(), [
      'body' => 'required'
    ]);

    $thread->addReply([
      'body' => request('body'),
      'user_id' => auth()->id()
    ]);

    return redirect($thread->path());
  }

  public function destroy(Reply $reply)
    {
        if ($reply->user_id != auth()->id()) {
            return response([], 403);
        }
        $reply->delete();
        return back();
    }
}
