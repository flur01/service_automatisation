@extends('layouts.main')

@section('page_title')
Додати продаж
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
            {{ __('Add Sale') }}
        </div>
        <div class="card-body">
            <form class="form" action={{ route('add-gadget') }} method="post" >
                @csrf

                <add-form-component ></add-form-component>

                <label for="name">{{ __('Sale Date') }}</label>
                <span class="date" id="date">{{ date('d-m-Y') }}</span>

                <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            </form>
        </div>
    </div>

@endsection
