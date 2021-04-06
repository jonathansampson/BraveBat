@extends('layouts.app-no-search')

@section('title', 'Advanced Search')
@section('description', 'Search for your favovite Brave creators on the web, YouTube, Twitch, Twitter, GitHub and
Vimeo')

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 md:px-8">
    <advanced-search initial-term="{{$initialTerm}}"></advanced-search>
</div>
@endsection