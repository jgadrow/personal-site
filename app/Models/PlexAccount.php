<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlexAccount extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class)
            ->withPivot('rating');
    }

    public function tracks() {
        return $this->belongsToMany(Track::class)
            ->withPivot('rating');
    }

    public function tvEpisodes() {
        return $this->belongsToMany(TvEpisode::class)
            ->withPivot('rating');
    }
}

