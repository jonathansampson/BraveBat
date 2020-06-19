@extends('layouts.app')

@section('title', 'Creator Validation by Channels')
@section('description', 'Creator Validation by Channels: YouTube, GitHub, Twitter, Twitch, and Vimeo')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        @foreach ($channels as $channel => $title)
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">
                {{$title}}
            </h1>
            <div class='mb-3 mr-4'>
                @include('charts.line', ['id' => 'creator_validation/'.$channel, 'brand_color' => $channel, 'unit'
                =>'day'])
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
