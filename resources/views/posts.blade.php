@extends('layouts.rate-master')

@section('content')
<div class="bg-secondary p-5 rounded">
    @auth
    <h1 class="lead text-white"><strong>Only the author of the posts can delete or update it.</strong></h1>
    @endauth
</div>

<div class="bg-light p-5 rounded mt-2">
    @auth
    <h1>Posts</h1>
    <p class="lead"><strong>Please rate the posts below to help us understand th perfect post.</strong></p>
    <table class="table table-bordered">
        <tr>
            <th><h2>Id</h2></th>
            <th><h2>Name</h2></th>
            <th><h2>Title</h2></th>
            <th><h2>content</h2></th>
            <th width="400px"><h2>Star</h2></th>
            <th width="100px"><h2>View</h2></th>
        </tr>
        @if($posts->count())
        @foreach($posts as $post)
        <tr>
            <td><h4>{{ $post->id }}</h4></td>
            <td><h4>{{ $post->name }}</h4></td>
            <td><h4>{{ $post->title }}</h4></td>
            <td><h4>{{ $post->content }}</h4></td>
       
       
            <td>
                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $post->averageRating }}" data-size="xs" disabled="">
            </td>
            <td>
                <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary btn-lg">View</a>
            </td>
        </tr>
        @endforeach
        @endif
    </table>
    @endauth
</div>
@endsection