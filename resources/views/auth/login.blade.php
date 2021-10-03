@extends('layouts.auth-master')

@section('content')
<a href="{{'/'}}" class="nav-link px-2 text-secondary"><<<  Go Back</a>

<hr/>
<form method="post" action="{{ route('login.perform') }}">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <h1 class="h3 mb-3 fw-normal">Login</h1>

    @include('layouts.partials.messages')

    <div class="form-group form-floating mb-3">
        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
        <label for="floatingName">Email or Username</label>
        @if ($errors->has('username'))
        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
        @endif
    </div>

    <div class="form-group form-floating mb-3">
        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
        <label for="floatingPassword">Password</label>
        @if ($errors->has('password'))
        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <div class="form-group mb-3">
        <label for="remember">Remember me</label>
        <input type="checkbox" name="remember" value="1">
    </div>

    <div class="form-group mb-3">
        <button class="w-45 btn btn-lg btn-primary" type="submit">Login</button>
        <a href="{{'/' }}" class="w-45 btn btn-lg btn-warning" type="submit">Back</a>
    </div>
    @include('auth.partials.copy')
</form>
@endsection