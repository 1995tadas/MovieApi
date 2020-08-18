@extends('layouts.app')
@section('content')
    <trending-component
        trending-url="https://api.themoviedb.org/3/trending/movie/day?api_key={{config('services.movieApi.key')}}"
        show-route="{{route('show',['id'=> '/'])}}"
    >
    </trending-component>
@endsection
