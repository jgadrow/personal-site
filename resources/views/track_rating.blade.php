@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" type="text/css" href="css/data_table.css" />
@endpush

@section('title', 'Track Ratings')

@section('content')
  <table>
    <thead>
      <th>Artist</th>
      <th>Album</th>
      <th>Track #</th>
      <th>Title</th>
      <th>Rating</th>
    <thead>
    <tbody>
@if (!count($ratings))
      <tr>
        <td colspan="5">No Ratings Exist!</td>
      </tr>
@else
  @foreach ($ratings as $rating)
      <tr>
        <td>{{ $rating->artist }}</td>
        <td>{{ $rating->album }}</td>
        <td>{{ $rating->track_number }}</td>
        <td>{{ $rating->name }}</td>
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

