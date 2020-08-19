<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function index($query)
    {
        if (request()->filled('page')) {
            $page = request()->page;
        } else {
            $page = 1;
        }
        $client = new Client();
        try {
            $response = $client->request(
                'GET',
                'https://api.themoviedb.org/3/search/movie/',
                [
                    'query' => [
                        'api_key' => config('services.movieApi.key'),
                        'page' => $page,
                        'include_adult' => 'false',
                        'query' => $query
                    ]
                ]
            );
            $status = $response->getStatusCode();
        } catch (\Exception $e) {
            $status = $e->getResponse()->getStatusCode();
        }

        if ($status === 200) {
            return view('search', ['data' => json_decode($response->getBody())]);
        } else if ($status === 422) {
            return view('search', ['error' => 'Page don\'t exist']);
        }
    }
}
