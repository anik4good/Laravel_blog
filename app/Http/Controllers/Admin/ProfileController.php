<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;


class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);


        $image = $request->file('image');
        $slug = str::slug($request->name);
        $user = User::findOrFail(Auth::user()->id);


        //checking image if uploaded
        if (isset($image)){

            $datetime= Carbon::now()->toDateString();
            $ext = str::slug($image->getClientOriginalExtension());
            $imgname = $slug.'-'.$datetime.'-'.Str::random(10).'.'.$ext;

                //Creating a directory if not exsits
            if (!Storage::disk('public')->exists('profile')) {
               Storage::disk('public')->makeDirectory('profile');
            }
//                checking if images is already  there then delete
            if (Storage::disk('public')->exists('profile/'.$user->image)) {
                Storage::disk('public')->delete('profile/'.$user->image);
             }

            // image resize
             $proimage = Image::make($image)->resize(300, 200)->stream();
             Storage::disk('public')->put('profile/'.$imgname,$proimage);

        }
        else
        {
            // put default image if no image select
            $imgname = $user->image;

        }

        //now saving all to database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imgname;
        $user->about = $request->about;
        $user->update();
        Toastr::success('Profile Data Successfully Updated');
        return redirect()->back();

    }
}
