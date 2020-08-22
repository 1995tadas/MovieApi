@extends('layouts.app')
@section('content')
    <div class="custom-container">
        {{--        {{dd($data)}}--}}
        @if(isset($error))
            <div class="error">{{$error}}</div>
        @else
            <div class="search-results">
                @foreach($data->results as $movie)
                    <a class="search-thumbnail" href="{{route('movie.show',['id'=>$movie->id])}}">
                        @if(isset($movie->poster_path))
                            <img src="https://image.tmdb.org/t/p/w154/{{$movie->poster_path}}" alt="Poster thumbnail">
                        @else
                            <img src="{{asset('images/placeholder-movieimage-154.png')}}"
                                 alt="Poster thumbnail placeholder">
                        @endif
                        <h6 class="search-title">{{$movie->title}}</h6>
                    </a>
                @endforeach
            </div>
            <div class="search-pagination">
                @foreach($pageList['pages'] as $page)
                    <a class="search-page {{$pageList['currentPage'] == $page?'search-current-page':null}}"
                       @if(is_numeric($page)) href="{{route('search.index',['query'=>$query])}}?page={{$page}}" @endif
                    >
                        {{$page}}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
