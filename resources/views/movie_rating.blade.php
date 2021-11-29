@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" type="text/css" href="css/data_table.css" />
@endpush

@section('title', 'Movie Ratings')

@section('content')
  <table>
    <thead>
      <th>Movie</th>
      <th>Year</th>
      <th>Rating</th>
    <thead>
    <tbody>
@if (!count($ratings))
      <tr>
        <td colspan="3">No Ratings Exist!</td>
      </tr>
@else
  @foreach ($ratings as $rating)
      <tr>
        <td>{{ $rating->name }}</td>
        <td>{{ $rating->year }}</td>
        <td>
    @foreach ($rating->plexAccounts as $account)
          {{ $account->id }}:
      @for ($i = 0; $i < $account->pivot->rating; $i++)
          &#11088;
      @endfor
    @endforeach
        </td>
      </tr>
  @endforeach
@endif
    </tbody>
  </table>
  {{ $ratings->links() }}
@endsection

