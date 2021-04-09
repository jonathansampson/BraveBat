@extends('layouts.app')
{{--
@section('title', 'Brave Ad Campaigns and Supported Countries')
@section('description', 'Brave Ad Campaigns and Supported Countries') --}}

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
  <div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>name</th>
          <th>Website</th>
          <th>Logo</th>
          <th>More</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($adsAdvertisers as $adsAdvertiser)
        <tr>
          <td>{{$adsAdvertiser->id}}</td>
          <td>{{$adsAdvertiser->name}}</td>
          <td>{{$adsAdvertiser->website}}</td>
          <td>{{$adsAdvertiser->logo}}</td>
          <td>
            <a href="{{route('ads_advertisers.show', $adsAdvertiser)}}">More Details</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection