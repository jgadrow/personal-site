<?php

namespace App\Http\Controllers;

use App\Models\TvEpisode;
use Illuminate\Http\Request;

class EpisodeRatings extends Controller
{
  public function show() {
    return view(
      'episode_rating',
      [
        'ratings' => TvEpisode::orderBy('tv_show', 'asc')
          ->orderBy('season_index', 'asc')
          ->orderBy('episode_index', 'asc')
          ->paginate(10)
      ]
    );
  }
}

