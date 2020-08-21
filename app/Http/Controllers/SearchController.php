<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\PaginationService;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    public function index(SearchRequest $request, $query, PaginationService $paginationService)
    {
        if ($request->filled('page')) {
            $page = $request->page;
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
        if (isset($response)) {
            $body = json_decode($response->getBody());
        }
        if ($status === 422 || $status === 34) {
            return view('search', ['error' => 'Page don\'t exist']);
        } else if ($body->total_pages <= 0) {
            return view('search', ['error' => 'Nothing was found']);
        } else if ($status === 200) {
            $pageList = $paginationService->paginationForSearch($page, $body->total_pages);
            return view('search', ['data' => $body], compact('pageList', 'query'));
        }
    }
}
