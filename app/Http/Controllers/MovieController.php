<?php

namespace App\Http\Controllers;

class MovieController extends Controller
{
    public function show($id)
    {
        return view('show', ['movie_id' => $id]);
    }
}
