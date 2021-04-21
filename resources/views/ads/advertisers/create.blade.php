@extends('layouts.app')

@section('title', "Add Brave Advertisers")
@section('description', 'Add a new advertiser on Brave Browser')

@section('content')
<div>
  <form method="post" action="{{route('ads_advertisers.store')}}">
    @csrf
    <label for="name">Company Name</label>
    <input type="text" id="name" name="name">
    <label for="website">Company Website</label>
    <input type="text" id="website" name="website">
    <button type="submit">Submit</button>
  </form>
</div>
@endsection