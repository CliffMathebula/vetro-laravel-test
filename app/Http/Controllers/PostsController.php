<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('viewPost', compact('post'));
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


    /**
     * show Create post template
     *
     * @return \Illuminate\Http\Response
     */

    public function show_create()
    {
        return view('createPost');
    }


    /**
     * Create post
     *
     * @return \Illuminate\Http\Response
     */

    public function create_post(Request $request)
    {
        $user_id = Auth::id();

        request()->validate([
            'name' => ['required', 'string', 'min:5', 'max:200'],
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'content' => ['required', 'string', 'min:50', 'max:5000']
        ]);

        if (Post::create([
            'user_id' => $user_id,
            'name' => $request['name'],
            'title' => $request['title'],
            'content' => $request['content']
        ])) {
            return redirect('/posts')->with('success', "Post successfully created.");
        }
        return redirect('/posts')->with('errors', "Failed to create post.");
    }

    /**
     * destroy post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) //delete post for current logged in user
    {
        $user_id = Auth::id();
        $author_id = $request['user_id'];
        $post_id = $request['id'];

        if ($user_id == $author_id) { //checks if post belong to user
            DB::delete('delete from posts where id = ?', [$post_id]);
            return ('<script type="text/javascript">alert("Post deleted successfully");window.location.href = "/posts";</script>');
        }
        return ('<script type="text/javascript">alert("Failed to Delete Post, Post Belongs to another User"); window.location.href = "/posts"; </script>');
    }


    /**
     * destroy post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_post(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'min:5', 'max:200'],
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'content' => ['required', 'string', 'min:50', 'max:5000']
        ]);

        $post_id = $request->input('post_id'); //get post idfrom the form
        $user_id = $request->input('user_id'); //get post idfrom the form
        $author_id = Auth::id();

        if ($author_id == $user_id) {
            $post = Post::find($post_id);
            $post->name = $request->input('name');
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();

            return ('<script type="text/javascript"> alert("Post content Updated Successfully!"); window.location.href = "/posts";</script>');
        } else {
            return ('<script type="text/javascript">alert("Failed to Delete Post, Post Belongs to another User"); window.location.href = "/posts"; </script>');          
        }
    }
}
