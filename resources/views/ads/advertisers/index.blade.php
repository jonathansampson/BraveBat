@extends('layouts.app')

@section('title', "Brave Advertisers")
@section('description', 'A list of all advertisers on Brave Browser')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
  <ads-advertiser-list></ads-advertiser-list>
</div>
@endsection