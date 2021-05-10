@extends('layouts.app')

@section('title', 'Resource on Brave Browser, BAT and Beyond')
@section('description', 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate
communities')

@section('content')
<div>
    <div class='container px-4 py-20 mx-auto sm:px-6 md:px-8 sm:py-32'>
        <div class="flex items-center justify-center">
            <div class="text-center">
                <h1 class="pb-4 text-3xl font-bold leading-normal sm:pb-8 md:text-4xl lg:text-5xl">
                    Brave Together
                </h1>
                <p class="pb-8 text-sm leading-normal text-gray-700 sm:text-lg sm:pb-16">
                    Earn crypto, protect privacy, and support creators by switching to Brave Browser
                    today
                </p>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-download-badge></x-download-badge>
        </div>
    </div>
</div>
<benefits-cards></benefits-cards>
<stats-cards :stats="{{json_encode($creatorStats)}}"></stats-cards>
<div class="container px-4 py-16 mx-auto sm:px-6 md:px-8">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <creator-donut-chart url="/creator_stats/by_channels" title="Verified Creator Platform Distribution" />
        </div>
        <div>
            <toggleable-line-chart url="/charts/creator_stats" title="Brave Verified Creators" :toggleable="false" />
        </div>
        <div>
            <toggleable-line-chart url="/charts/dau" title="Brave Browser DAU (M)" :toggleable="false" />
        </div>
        <div>
            <toggleable-line-chart url="/charts/bat_purchases_in_dollars" title="Brave-Initiated BAT Purchase ($)"
                :toggleable="false" />
        </div>
        <div>
            <toggleable-line-chart url="/charts/active_ad_campaigns" title="Brave Ads Active Campaigns" />
        </div>
        <div>
            <toggleable-line-chart url="/charts/bat_price" title="BAT Price ($)" />
        </div>
    </div>
</div>
@endsection