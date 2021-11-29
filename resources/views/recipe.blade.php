@extends('layouts.app')

@section('title', $recipe->name)

@section('content')
  <h1><?=$recipe->name?></h1>
  <h2>Ingredients</h2>
  <ul>
  @foreach ($recipe->ingredients as $ingredient)
    <li>
      <?=$ingredient->amount?>
      <?=$ingredient->uom?>
      <?=$ingredient->name?>
      <?=$ingredient->note?>
    </li>
  @endforeach
  </ul>
  <h2>Directions</h2>
  <ol>
  @foreach ($recipe->steps as $step)
    <li><?=$step->text?></li>
  @endforeach
  </ol>
@endsection

