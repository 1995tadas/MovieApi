<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name','Laravel')}}</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
    <script src="https://kit.fontawesome.com/3c45c07865.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="app">
    <nav>
        <div>
            <a href="{{route('home')}}">Home</a>
        </div>
        <div>
            <search-component
                search-route="{{route('search.index',['query' => '/'])}}"
            >
            </search-component>
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </nav>
    @yield('content')
</div>
</body>
</html>
