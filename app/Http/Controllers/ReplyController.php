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
        $this->authorize('update', $reply); // TODO: THIS AUTHORISES THE DELETE
        $reply->delete();
        if (request()->expectsJson()) {
         return response(['status' => 'Reply deleted']);
        }
        return back();
    }
}
