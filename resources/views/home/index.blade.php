@extends('layouts.app-master')
@section('content')
<div class="bg-light p-5 rounded">
    @auth
    <h1>Dashboard</h1>
    <p class="lead">Only authenticated users can access this section.</p>
    <a class="btn btn-lg btn-primary" href="{{'/posts'}}" role="button">View all posts &raquo;</a>
    <a class="btn btn-lg btn-primary" href="{{'/post'}}" role="button">Create Post &raquo;</a>
    @endauth


    
    @guest
    <h1>Homepage</h1>
    <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>

    <div class="bg-secondary p-5 rounded">
    <h1 class="lead text-white"><strong>Only the author of the posts can delete or update it.</strong></h1>
    
</div>

<div class="bg-warning p-5 rounded mt-2">
    
    <h1>Posts</h1>
    <p class="lead"><strong>Please rate the posts below to help us understand th perfect post.</strong></p>
    <hr />
    @if($posts->count())
    @foreach($posts as $post)

    <p><strong>Date Posted: {{ $post->created_at }}</strong></p>
    <p><strong>Post Name:{{ $post->name }}</strong></p>
    <p><strong>Post Title: {{ $post->title }}</strong></p>
    <br />
    <p><strong> Post Content:</strong></p>
    <div>
        <p class="lead">{{ $post->content }}</p>
    </div>

    <p class="lead"><strong> <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $post->averageRating }}" data-size="xs" disabled="">
            <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary btn-lg">Rate Post &raquo;</a>

            <a href="{{url('post_edit')}}/{{ $post->user_id }}/{{ $post->id }}" class="btn btn-info btn-lg">Edit Post &raquo;</a>
            <a href="{{url('post')}}/{{ $post->id }}/{{ $post->user_id }}" class="btn btn-danger btn-lg">Delete &raquo;</a>

        </strong></p>
    <hr />

    @endforeach
    @endif

    
</div>
    @endguest
</div>
@endsection