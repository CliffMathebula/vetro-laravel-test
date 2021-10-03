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
        /**
         * this avoids returning of laravel errors if post not available
         *  it will redirect user back to posts
         *  especially if user changes the user id on the browser link 
         **/
        if ($post = Post::find($id)) {
            return view('viewPost', compact('post'));
        } else {
            return redirect('/posts')->with('errors', "post not available");
        }
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
            return ('<script type="text/javascript">alert("Post created successfully");window.location.href = "/posts";</script>');
        }
        return redirect('/posts');
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
     * show template to update post
     *
     * @return \Illuminate\Http\Response
     */
    public function select_post(Request $request)
    {

        $user_id = Auth::id(); //logged in user id
        $author_id = $request['auth_id']; //user id of post creater
        $post_id = $request['post_id']; //post id

        if ($user_id == $author_id) { //cheks to see if post belong to the user
            $post_details = DB::table('posts')->where('id', $post_id)->orderBy('id', 'desc')->get();
            return view('edit_post', ['post_details' => $post_details]);
        }
        return ('<script type="text/javascript">alert("Error! You cannot edit a post that is not posted by you");window.location.href = "/posts"; </script>');
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
            'content' => ['required', 'string', 'min:50', 'max:5000'],
            'post_id' => ['required'],
            'user_id' => ['required']
        ]);

        $post_id = $request->input('post_id'); //get post idfrom the form
        $user_id = $request->input('user_id'); //get post idfrom the form
        $author_id = Auth::id();

        if ($author_id == $user_id) { //compare the current user_id and post_id if are the same to confirm if post belong to the user
            $post = Post::find($post_id);
            $post->name = $request->input('name');
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();

            return ('<script type="text/javascript"> alert("Post content Updated Successfully!"); window.location.href = "/posts";</script>');
        } else { //retur this alert if post doesn't belong to the current logged in user
            return ('<script type="text/javascript">alert("Failed to Update Post, Post Belongs to another User"); window.location.href = "/posts"; </script>');
        }
    }
}
