@extends('layouts.app')

@section('title', 'Creator Validation by Channels')
@section('description', 'Creator Validation by Channels: YouTube, GitHub, Twitter, Twitch, and Vimeo')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        @foreach ($channels as $channel => $title)
        <div>
            <toggleable-line-chart url="{{"/charts/creator_validation/".$channel}}" brand="{{$channel}}"
                title="{{$title}}" />
        </div>
        @endforeach
    </div>
</div>
@endsection