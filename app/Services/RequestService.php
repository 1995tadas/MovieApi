<?php

namespace App\Services;

class RequestService
{
    private const MOVIE_DB_API_URL = "https://api.themoviedb.org/3/";
    private $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }

    public function performGetRequestMovieApi(string $query = '', array $parameters = [])
    {
        return $this->apiService->performGetRequest(self::MOVIE_DB_API_URL, $query, $parameters);
    }
}
