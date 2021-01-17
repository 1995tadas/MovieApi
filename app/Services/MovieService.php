<?php

namespace App\Services;

class MovieService
{
    private const API_QUERY_FOR_TRENDING_MOVIES = 'trending/movie/day';

    public function fetchTrendingMoviesFromApi(): object
    {
        $requestService = new RequestService();
        return $requestService->performGetRequestMovieApi(self::API_QUERY_FOR_TRENDING_MOVIES,
            ['api_key' => config('app.movies_api_key')]);
    }
}
