@extends('layouts.app')
@section('content')
    <div class="custom-container">
        @if(isset($error))
            <div>{{$error}}</div>
        @else
            <div class="search-results">
                @foreach($data->results as $movie)
                    <a class="search-thumbnail" href="{{route('movie.show',['id'=>$movie->id])}}">
                        <div>
                            @if(isset($movie->release_date))
                                <img src="https://image.tmdb.org/t/p/w154/{{$movie->poster_path}}" alt="">
                            @endif
                            <div>{{$movie->title}}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
