@extends('layouts.app')
@section('content')
    <trending-component
        trending-url="https://api.themoviedb.org/3/trending/movie/day?api_key={{config('services.movieApi.key')}}"
        film-reel = "{{asset('images\film-reel.png')}}"
        show-route="{{route('movie.show',['id'=> '/'])}}"
    >
    </trending-component>
@endsection
