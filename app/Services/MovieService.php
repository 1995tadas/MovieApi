<?php

namespace App\Services;

class MovieService
{
    private const API_QUERY_FOR_TRENDING_MOVIES = 'trending/movie/day';
    private const API_QUERY_FOR_MOVIE = 'movie';

    public function fetchTrendingMoviesFromApi(): object
    {
        $requestService = new RequestService();
        return $requestService->performGetRequestMovieApi(self::API_QUERY_FOR_TRENDING_MOVIES,
            ['api_key' => config('app.movies_api_key')]);
    }

    public function fetchMovieFromApi(int $movieId): object
    {
        $requestService = new RequestService();
        return $requestService->performGetRequestMovieApi(self::API_QUERY_FOR_MOVIE . '/' . $movieId,
            ['api_key' => config('app.movies_api_key')]);
    }

    public function prepareMovie(object $movie): array
    {
        $preparedMovie = [];
        if ($movie->poster_path) {
            $preparedMovie['poster_path'] = 'https://image.tmdb.org/t/p/w342' . $movie->poster_path;
        }

        $preparedMovie['title'] = $movie->title;
        if ($movie->title !== $movie->original_title) {
            $preparedMovie['original_title'] = $movie->original_title;
        }

        if ($movie->tagline) {
            $preparedMovie['tagline'] = $movie->tagline;
        }

        if (count($movie->genres) !== 0) {
            $preparedMovie['genres'] = [];
            foreach ($movie->genres as $genre) {
                $preparedMovie['genres'][] = $genre->name;
            }
        }

        if (count($movie->spoken_languages) !== 0) {
            $preparedMovie['spoken_languages'] = [];
            foreach ($movie->spoken_languages as $index => $language) {
                $preparedMovie['spoken_languages'][$index][] = $language->english_name;
            }
        }

        if (count($movie->production_companies) !== 0) {
            $preparedMovie['production_companies'] = [];
            foreach ($movie->production_companies as $company) {
                $preparedMovie['production_companies'][] = $company->name;
            }
        }

        $preparedMovie['status'] = $movie->status;
        if ($movie->budget > 0) {
            $preparedMovie['budget'] = $movie->budget;
        }

        if ($movie->release_date) {
            $preparedMovie['release_date'] = $movie->release_date;
        }

        if ($movie->runtime > 0) {
            $preparedMovie['runtime'] = $movie->runtime;
        }

        if ($movie->homepage) {
            $preparedMovie['homepage'] = $movie->homepage;
        }

        if ($movie->imdb_id) {
            $preparedMovie['imdb'] = 'https://www.imdb.com/title/' . $movie->imdb_id;
        }

        if ($movie->overview) {
            $preparedMovie['overview'] = $movie->overview;
        }

        return $preparedMovie;
    }
}
