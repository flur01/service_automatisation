<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @include('includes.header')

    @if(Session::has('message'))
        <div class="message">
        {{Session::get('message')}}
        </div>
    @endif


    @if(($errors->any()))
        <div class="error">
            @yield('message_section')
        </div>
    @endif


    <div id="app" class="container-xl">
        @yield('main_content')
    </div>

    @include('includes.footer')

</body>
</html>
