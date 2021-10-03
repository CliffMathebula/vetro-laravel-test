@extends('layouts.app-master')

@section('content')
<div class="col">
    <div class="card text-white bg-secondary">
        <div class="card-body">
            <h5 class="card-title text-center text-white"><small>ADD BLOG POST</small></h5>
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

            <form method="post" action="{{ route('post.perform') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
       
            <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Title') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('Post Title') is-invalid @enderror" name="title" value="" required autocomplete="Title" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-4 col-form-label text-md-left text-dark">{{ __('Post Content') }}</label>
                    <div class="col-md-6">
                        <textarea class="form-control  @error('content') is-invalid @enderror" id="content" name="content" rows="3">
                        
                        </textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

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
            
        </div>
    </div>
    @endsection