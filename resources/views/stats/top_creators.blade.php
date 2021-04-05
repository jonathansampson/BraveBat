@extends('layouts.app')

@section('title', 'Top Creators by Channels')
@section('description', 'Top Creators by Channels: Website, YouTube, GitHub, Twitter, Twitch, and Vimeo')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <toggleable-line-chart url="/charts/top_creators/youtube" brand="youtube"
                title="Youtube Creators with >1M Subscribers">
            </toggleable-line-chart>
        </div>

        <div>
            <toggleable-line-chart url="/charts/top_creators/website" brand="website"
                title="Websites under 1K Alexa Ranking">
        </div>

        <div>
            <toggleable-line-chart url="/charts/top_creators/twitch" brand="twitch"
                title="Twitch Creators with >100K Followers">
        </div>

        <div>
            <toggleable-line-chart url="/charts/top_creators/twitter" brand="twitter"
                title="Twitter Creators with >1M Followers">
        </div>

        <div>
            <toggleable-line-chart url="/charts/top_creators/vimeo" brand="vimeo"
                title="Vimeo Creators with >1K Followers">
        </div>

        <div>
            <toggleable-line-chart url="/charts/top_creators/github" brand="github"
                title="GitHub Creators with >1K Followers">
        </div>
    </div>
</div>
@endsection