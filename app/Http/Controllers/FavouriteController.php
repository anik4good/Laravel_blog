<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function add($id)
    {
       $user = Auth::user();
       $is_favourite_post = $user->favourite_posts()->where('post_id',$id)->count();
       if($is_favourite_post==0)
       {
           $user->favourite_posts()->attach($id);
           Toastr::success('Added to Favourite');
           return redirect()->back();
       }
       else{
           $user->favourite_posts()->detach($id);
           Toastr::error('Removed from Favourite');
           return redirect()->back();
       }
   }
}
