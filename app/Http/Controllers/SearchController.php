<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\MovieService;
use App\Services\PaginationService;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($request->page) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        $query = $request->search_query;
        $movieService = new MovieService();
        $results = $movieService->searchMovieFromApi($query, $page);
        $paginationService = new PaginationService();
        $pageList = $paginationService->paginationForSearch($page, $results->total_pages);
        return view('search', ['data' => $results], compact('pageList', 'query'));
    }
}
