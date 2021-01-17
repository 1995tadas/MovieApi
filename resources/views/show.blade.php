@extends('layouts.app')
@section('content')
    <show-component
        :translation="{{ json_encode(trans('movies')) }}"
        movie-route="{{ route('movies.movie', ['id' => $movieId]) }}"
        film-reel="{{ asset('images/film-reel.png')}}"
        poster-placeholder="{{ asset('images/placeholder-movie.png') }}">
    </show-component>
@endsection
