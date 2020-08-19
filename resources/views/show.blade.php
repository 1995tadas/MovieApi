@extends('layouts.app')
@section('content')
    <show-component
        movie-route="https://api.themoviedb.org/3/movie/{{$movie_id}}?api_key={{config('services.movieApi.key')}}"
        poster-placeholder = "{{asset('images/placeholder-movieimage.png')}}"
    >
    </show-component>
@endsection
