<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{


    public function singlepost($slug)
    {

        $random_posts = Post::latest()->take(6)->get();
        $posts = Post::where('slug', $slug)->approved()->status()->first();
        $comments = $posts->comments()->latest()->get();

        $blog_key = 'blog_' . $posts->id;
        if (!Session::has($blog_key)) {
            $posts->increment('view_count');
            Session::put($blog_key, 1);
        }

        return view('single_post', compact('posts', 'random_posts', 'comments'));


    }

    public function allpost()
    {
        $posts = Post::latest()->approved()->status()->paginate(2);
        $categories = Category::all();
        return view('posts', compact('categories', 'posts'));
    }

    public function postbycategory($slug)
    {


        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->status()->get();
        return view('category_post', compact('category', 'posts'));

    }

    public function postbytag($slug)
    {


        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->approved()->status()->get();
        return view('tag_post', compact('tag', 'posts'));

    }
}
