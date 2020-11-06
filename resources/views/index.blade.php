@extends('layouts.main')

@section('page_title')
{{ __('Main Page') }}
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
        <gadgets-output-component></gadget-output-component>
@endsection
