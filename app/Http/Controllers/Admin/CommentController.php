<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();

        return view('admin.comment', compact('comments'));

    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        Toastr::error('Comment deleted ');
        return redirect()->back();

    }
}
