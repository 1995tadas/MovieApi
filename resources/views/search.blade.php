@extends('layouts.app')
@section('content')
    <div class="custom-container">
        @empty($data->results)
            <div class="search-empty">{{__('search.search_empty')}}</div>
        @else
            <div class="search-results">
                @foreach($data->results as $movie)
                    <a href="{{ route('movie.show', ['id' => $movie->id])}} ">
                        @if(isset($movie->poster_path))
                            <img src="https://image.tmdb.org/t/p/w154/{{ $movie->poster_path }}"
                                 alt="{{ $movie->title . ' ' . __('thumbnail') }}">
                        @else
                            <img src="{{ asset('images/placeholder-movie-small.png') }}"
                                 alt="{{ $movie->title . ' ' . __('search.thumbnail_placeholder') }}">
                        @endif
                        <h6 class="search-title">{{$movie->title}}</h6>
                    </a>
                @endforeach
            </div>
            <div class="search-pagination">
                @foreach($pageList['pages'] as $page)
                    <a class="search-page {{ $pageList['currentPage'] == $page ? 'search-current-page' : null }}"
                       @if(is_numeric($page))
                       href="{{ route('search.index', ['search_query' => $query, 'page' => $page]) }}"
                        @endif>
                        {{$page}}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
