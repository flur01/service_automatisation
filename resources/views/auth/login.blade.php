@extends('layouts.main')

@section('page_title')
{{ __('Auth') }}
@endsection

@section('message_section')

    @error('login')
        <p>{{ $message }}</p>
    @enderror


    @error('password')
        <p>{{ $message }}</p>
    @enderror
@endsection


@section('main_content')

<div class="card border-secondary card-signin">
    <div class="card-header">
        {{ __('Auth') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="exampleInputEmail1">{{ __('Login') }}</label>
                <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus id="exampleInputEmail1">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword1">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">{{ __('Remember Me') }}</label>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Sign In') }}</button>
        </form>
    </div>
</div>

@endsection
