<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread)
    {

      $data = \request()->validate([
          'body'=>'required'
      ]);
        $thread->addReply([
            'body' => $data['body'],
            'user_id' => auth()->id()
        ]);
        return back()->with('flash','Your reply has been left.');
    }

    public function delete(Reply $reply)
    {
//        if ($reply->user_id != auth()->id()){
//            return response([],403);
//        }
        $this->authorize('update',$reply);
        $reply->delete();
        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update',$reply);
       $reply->update(['body'=>\request('body')]);
    }

}
