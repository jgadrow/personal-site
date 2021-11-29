@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" type="text/css" href="css/data_table.css" />
@endpush

@section('title', 'TV Episode Ratings')

@section('content')
  <table>
    <thead>
      <th>Show</th>
      <th>Season #</th>
      <th>Episode #</th>
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
        <td>{{ $rating->tv_show }}</td>
        <td>{{ $rating->tv_season }}</td>
        <td>{{ $rating->episode_index }}</td>
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

