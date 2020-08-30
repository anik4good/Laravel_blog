<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $popular_posts = Post::withCount('favourite_to_users', 'comments')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('favourite_to_users_count', 'desc')
            ->take(5)->get();

        $all_posts = Post::approved()->status()->get();
        //  $fav =$posts->withCount('favourite_to_users')->get();
        $total_views = Post::sum('view_count');
        $total_pending_posts = Post::where('is_approved', false)->count();
        $total_authors = User::where('role_id', 2)->count();
        $total_authors_today = User::where('role_id', 2)->whereDate('created_at', Carbon::today())->count();
        $categories = Category::all()->count();
        $tags = Tag::all()->count();
        return view('admin.dashboard', compact('all_posts', 'popular_posts', 'total_views', 'total_pending_posts', 'total_authors', 'total_authors_today','categories','tags'));

    }

}
