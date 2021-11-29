<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
  use Concerns\UsesUuid;

  public $timestamps = false;

  public function ingredients()
  {
    return $this->hasMany('App\Models\RecipeIngredient');
  }

  public function steps()
  {
    return $this->hasMany('App\Models\RecipeStep')->orderBy('position', 'asc');
  }
}

