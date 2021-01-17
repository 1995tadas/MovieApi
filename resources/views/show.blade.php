@extends('layouts.app')
@section('content')
    <show-component
        movie-route="https://api.themoviedb.org/3/movie/{{$movieId}}?api_key={{config('services.movieApi.key')}}"
        film-reel = "{{asset('images\film-reel.png')}}"
        poster-placeholder = "{{asset('images/placeholder-movieimage.png')}}">
    </show-component>
@endsection
