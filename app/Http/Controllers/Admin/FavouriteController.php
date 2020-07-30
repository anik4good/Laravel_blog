<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        $favourite_posts = Auth::user()->favourite_posts()->get();
        return view('admin.favourite',compact('favourite_posts'));
    }
}
