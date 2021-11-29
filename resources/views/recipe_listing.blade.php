@extends('layouts.app')

@section('title', 'Recipes')

@section('content')
  @if (!count($recipes))
    <p>No Recipes Exist!</p>
  @else
    <ul>
    @foreach ($recipes as $recipe)
      <li><a href="/recipes/<?=$recipe->id?>"><?=$recipe->name?></a></li>
    @endforeach
    </ul>
  @endif

  {{ $recipes->links() }}
@endsection

