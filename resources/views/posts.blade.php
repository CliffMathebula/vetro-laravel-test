@extends('layouts.rate-master')

@section('content')
<div class="bg-secondary p-5 rounded">
    @auth
    <a href="{{'/'}}" class="nav-link px-2 text-white"><<<  Go Back</a>
<br/><br/>
    <h1 class="lead text-white"><strong>Only the author of the posts can delete or update it.</strong></h1>
    @endauth
</div>

<div class="bg-warning p-5 rounded mt-2">
    @auth
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

    @endauth
</div>
@endsection