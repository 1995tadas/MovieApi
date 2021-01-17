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
}
