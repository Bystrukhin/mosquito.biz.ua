<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function commentLike()
    {
// using a command bus. Basically making a post to the likes table assigning user_id and comment_id then redirect back
        extract(Input::only('user_id', 'comment_id'));
        $this->execute(new CommentLikeCommand($user_id, $comment_id));

        return redirect()->back();
    }
    public function unlike()
    {
        $like = new Like;
        $user = Auth::user();
        $id = Input::only('comment_id');
        $like->where('user_id', $user->id)->where('comment_id', $id)->first()->delete();
        return redirect()->back();
    }
}
