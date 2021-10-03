@extends('layouts.app-master')

@section('content')
<div class="col">
    <div class="card text-white bg-secondary">
        <div class="card-body">
            <h5 class="card-title text-center text-white"><small>EDIT POST DETAILS</small></h5>
        </div>
    </div>

    <div class="card text-white bg-light">
        <div class="card-body">
            <!-- Returns the error by dislaying the alert  with the error message -->
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <!-- Returns the validation errors for required fields -->
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{ route('edit_post') }}">
                @csrf
                @if (!empty($post_details))
                @foreach($post_details as $post)
               
                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('Post Name') is-invalid @enderror" name="name" value="{{ $post->name }}" required autocomplete="Title" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Title') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('Post Title') is-invalid @enderror" name="title" value="{{ $post->title }}" required autocomplete="Title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cellphone" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Content') }}</label>
                    <div class="col-md-6">
                        <textarea class="form-control  @error('content') is-invalid @enderror" id="content" name="content" rows="3">
                        {{ $post->content }}
                        </textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input id="post_id" type="hidden" name="post_id" value="{{$post->id}}">
                <input id="user_id" type="hidden" name="user_id" value="{{$post->user_id}}">
                <div class="form-group row mb-0" l>
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/posts" class="btn btn-warning">
                            {{ __('cancel') }}
                        </a>
                    </div>
                </div>
            </form>
            @endforeach
            @endif
        </div>
    </div>
    @endsection