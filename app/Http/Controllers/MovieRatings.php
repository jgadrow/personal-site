<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieRatings extends Controller
{
  public function show() {
    return view(
      'movie_rating',
      [
        'ratings' => Movie::orderBy('name', 'asc')
          ->orderBy('year', 'asc')
          ->paginate(10)
      ]
    );
  }
}

