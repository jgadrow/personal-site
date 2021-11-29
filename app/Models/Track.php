<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
  use Concerns\UsesUuid;

  public $timestamps = false;

  public function plexAccounts() {
    return $this->belongsToMany(PlexAccount::class)->withPivot('rating');
  }
}

