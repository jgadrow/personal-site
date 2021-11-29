<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TrackRatings extends Controller
{
  public function show() {
    return view(
      'track_rating',
      [
        'ratings' => Track::orderBy('artist', 'asc')
          ->orderBy('album', 'asc')
          ->orderBy('track_number', 'asc')
          ->paginate(10)
      ]
    );
  }
}

