<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
  use Concerns\UsesUuid;

  public $timestamps = false;
}

