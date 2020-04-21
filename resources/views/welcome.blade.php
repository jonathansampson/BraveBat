@extends('layouts.app')

@section('title', 'Resource on Brave Browser, BAT and Beyond')
@section('description', 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate communities')

@section('content')
<div class="background-pattern">
    <div class='container px-4 py-20 mx-auto sm:px-6 md:px-8 sm:py-32'>
        <div class="flex items-center justify-center">
            <div class="text-center">
                <h1 class="pb-8 text-3xl leading-normal sm:pb-16 md:text-4xl lg:text-5xl">Brave Browser Verified Creators Tracker</h1>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center sm:flex-row">
            <div class="pb-8 sm:pb-0 sm:pr-8">
                <x-stats-badge></x-stats-badge>
            </div>
            <div class="sm:pl-8">
                <x-download-badge></x-download-badge>
            </div>
            
        </div>
    </div>
</div>
<div class="container px-4 pb-8 mx-auto sm:px-6 md:px-8">
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <h2 class="py-8 text-2xl font-semibold text-center">Verified Creator Platform Distribution</h2>

            <donut-chart 
                colors="{{json_encode(config('bravebat.creator_brand_colors'))}}" 
                identifier="bat_creator_summary"
                >
            </donut-chart>
        </div>
        <div class="w-full lg:w-1/2">
            <h2 class="py-8 text-2xl font-semibold text-center">Verified Creator Growth</h2>
            <line-chart 
                colors="{{json_encode(config('bravebat.colors'))}}" 
                identifier="creator_stats"
            >
            </line-chart>
        </div>

    </div>
 
</div>
@endsection

