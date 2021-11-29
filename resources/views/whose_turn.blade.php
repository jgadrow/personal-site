@extends('layouts.app')
@section('title', 'Whose Turn Is It?')

@section('content')
  <h1>It is <?= $current ?>'s turn!</h1>
  <p>Last Week: <?= $prev ?></p>
  <p>Next Week: <?= $next ?></p>
@endsection

