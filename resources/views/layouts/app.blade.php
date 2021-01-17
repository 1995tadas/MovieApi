<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
    <script src="https://kit.fontawesome.com/3c45c07865.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="app">
    <nav>
        <div>
            @if(!Route::is('home'))
                <a href="{{ route('home')}} ">{{__('others.home')}}</a>
            @endif
        </div>
        <div>
            <search-component :translation="{{ json_encode(trans('search')) }}"
                              search-route="{{ route('search.index') }}">
            </search-component>
        </div>
    </nav>
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
