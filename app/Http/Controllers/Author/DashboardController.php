<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $popular_posts = Post::withCount('favourite_to_users', 'comments')->where('user_id', Auth::id())
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favourite_to_users_count', 'desc')
            ->take(5)->get();
        $all_posts = Post::where('user_id', Auth::id())->approved()->status()->get();
        //  $fav =$posts->withCount('favourite_to_users')->get();
        $total_views = Post::where('user_id', Auth::id())->sum('view_count');
        $total_pending_posts = Post::where('is_approved', false)->count();
        $total_fav = Auth::user()->favourite_posts()->count();
        $total_comments = Auth::user()->comments()->count();
        return view('author.dashboard',
            compact('all_posts', 'popular_posts',
            'total_views', 'total_pending_posts', 'total_fav','total_comments'));

    }
}
