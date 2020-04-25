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
                    User Brave Browser to protect your online privacy and support {{round($creator_count / 1000) }}K
                    amazing verified creators
                </p>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <x-download-badge></x-download-badge>

        </div>
    </div>
</div>
<div class="container px-4 pb-8 mx-auto sm:px-6 md:px-8">
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <h2 class="py-8 text-2xl font-semibold text-center">Verified Creator Platform Distribution</h2>
            @include('charts.donut', ['id' => 'bat_creator_summary'])
        </div>
        <div class="w-full lg:w-1/2">
            <h2 class="py-8 text-2xl font-semibold text-center">Verified Creator Growth</h2>
            @include('charts.line', ['id' => 'creator_stats'])
        </div>
    </div>
</div>
@endsection