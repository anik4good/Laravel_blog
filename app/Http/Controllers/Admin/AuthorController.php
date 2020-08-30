<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
       return $author = User::Author()
           ->withCount('posts','favourite_posts','comments')
           ->get();
    }
}
