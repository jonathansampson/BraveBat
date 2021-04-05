@extends('layouts.app')

@section('title', 'Resource on Brave Browser, BAT and Beyond')
@section('description', 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate
communities')

@section('content')
<div class="border-b border-gray-200 background-pattern">
    <div class='container px-4 py-20 mx-auto sm:px-6 md:px-8 sm:py-32'>
        <div class="flex items-center justify-center">
            <div class="text-center">
                <h1 class="pb-4 text-3xl font-bold leading-normal sm:pb-8 md:text-4xl lg:text-5xl">
                    Support Brave Creators
                </h1>
                <p class="pb-8 text-sm leading-normal text-gray-700 sm:text-lg sm:pb-16">
                    Use Brave Browser to protect your online privacy and support
                    <span class="font-semibold">{{round($creator_count['overall'] / 1000000) }}M</span>
                    amazing verified creators
                </p>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-download-badge></x-download-badge>
        </div>
    </div>
</div>
<div class="container px-4 py-16 mx-auto sm:px-6 md:px-8">
    <div class="mb-8 text-3xl text-center">
        Thriving Platform Ecosystem
    </div>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <creator-donut-chart url="/charts/bat_creator_summary" title="Verified Creator Platform Distribution" />
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