<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(
            ["shite"],
            200
        );
    }
}