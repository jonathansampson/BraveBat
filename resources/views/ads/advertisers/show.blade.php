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
          <th>Website</th>
          <th>Name</th>
          <th>Logo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$adsAdvertiser->id}}</td>
          <td>{{$adsAdvertiser->website}}</td>
          <td>{{$adsAdvertiser->name}}</td>
          <td><img src="//logo.clearbit.com/https://paypal.com"></td>
        </tr>

      </tbody>
    </table>
  </div>
</div>
@endsection