@extends('layouts.main')

@section('page_title')
{{ __('Add Products List') }}
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
            {{ __('Add Products List') }}
        </div>

        <div class="card-body">
            <form class="form" action={{ route('to-add-product-list') }} method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="list">{{ __('Select File') }}</label>
                    <input type="file" name="list" class="btn"  accept=".xls, .xlsx">
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>

            </form>
            <a href="example/example.xls">{{ __('Download Example') }}</a>
        </div>
    </div>

@endsection
