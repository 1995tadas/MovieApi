@extends('layouts.app')
@section('content')
    <trending-component
        :translation="{{ json_encode(trans('movies')) }}"
        trending-url="{{ route('movies.trending') }}"
        film-reel="{{ asset('images\film-reel.png') }}"
        show-route="{{ route('movie.show',['id'=> '/']) }}">
    </trending-component>
@endsection
