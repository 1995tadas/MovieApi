<?php

namespace App\Http\Controllers;

use App\Services\MovieService;

class MovieController extends Controller
{
    public function show($id)
    {
        return view('show', ['movieId' => $id]);
    }

    public function fetchTrendingMovies(): \Illuminate\Http\JsonResponse
    {
        $movieService = new MovieService();
        $trendingMovies = $movieService->fetchTrendingMoviesFromApi();
        return response()->json($trendingMovies);
    }

    public function fetchMovie(int $id): \Illuminate\Http\JsonResponse
    {
        $movieService = new MovieService();
        $movie = $movieService->fetchMovieFromApi($id);
        $preparedMovie = $movieService->prepareMovie($movie);
        return response()->json($preparedMovie);
    }
}
