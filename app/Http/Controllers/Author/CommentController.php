<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;

        return view('author.comment', compact('posts'));

    }

    public function destroy($id)
    {
     $comment = Comment::find($id);

        if($comment->post->user->id != Auth::id())
        {
            Toastr::error('No Permission ');
            return redirect()->back();
        }
        else{
            $comment->delete();
            Toastr::success('Comment deleted ');
            return redirect()->back();
        }

   

    }
}


