<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Show posts dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('posts');
    }

    /**
     * Show all posts.
     *
     * @return \Illuminate\Http\Response
     */

    public function posts()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    /**
     * Show single post by user_id.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $post = Post::find($id);
        return view('postsShow', compact('post'));
    }

    /**
     * rate post.
     *
     * @return \Illuminate\Http\Response
     */

    public function postPost(Request $request)
    {
        request()->validate(['rate' => 'required']);
        
        $post = Post::find($request->id); 
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = auth()->user()->id;
        $post->ratings()->save($rating);

        return redirect()->route("posts");
    }
}
