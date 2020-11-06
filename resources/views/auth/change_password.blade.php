@extends('layouts.main')

@section('page_title')
{{ __('Change Password') }}
@endsection

@section('message_section')
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection

@section('main_content')
<div class="card border-secondary card-signin">
    <div class="card-header">
        {{ __('Change Password') }}
    </div>
    <div class="card-body">
        <form class="form" method="POST" action="{{ route('change-password') }}">
            @csrf
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="password-confirm">{{ __('Password Confirmation') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Change') }}</button>

        </form>
    </div>
</div>
@endsection
