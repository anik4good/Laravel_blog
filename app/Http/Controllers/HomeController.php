<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use http\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->take(6)->get();
        return view('welcome', compact('categories', 'posts'));
    }

    public function singlepost($slug)
    {

        $allposts = Post::latest()->take(6)->get();
        $posts = Post::where('slug',$slug)->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('post', compact('posts', 'categories', 'tags','allposts'));


    }
//    private function sendMessage($message, $recipients)
//    {
//        $account_sid = getenv("TWILIO_SID");
//        $auth_token = getenv("TWILIO_AUTH_TOKEN");
//        $twilio_number = getenv("TWILIO_NUMBER");
//        $client = new Client($account_sid, $auth_token);
//        $client->messages->create($recipients,
//            ['from' => $twilio_number, 'body' => $message] );
//    }
//
//    /**user
//     * Send message to a selected users
//     */
//    public function sendCustomMessage(Request $request)
//    {
//        $validatedData = $request->validate([
//            'users' => 'required|array',
//            'body' => 'required',
//        ]);
//        $recipients = $validatedData["users"];
//        // iterate over the array of recipients and send a twilio request for each
//        foreach ($recipients as $recipient) {
//            $this->sendMessage($validatedData["body"], $recipient);
//        }
//        return back()->with(['success' => "Messages on their way!"]);
//    }
//}

}
