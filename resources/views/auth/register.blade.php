@extends('layouts.main')

@section('page_title')
Додати магазин
@endsection

@section('message_section')

    @error('name')
        {{ $message }}
    @enderror

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
        {{ __('New Shop Adding') }}
    </div>
    <div class="card-body">
        <form class="form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Shop Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>

            <div class="form-group">
                <label for="login">{{ __('Login') }}</label>
                <input id="login" type="login" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            </div>

            <div class="form-group">    
                <label for="password-confirm">{{ __('Password Confirmation') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
                <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
        </form>
    </div>
</div>
@endsection
