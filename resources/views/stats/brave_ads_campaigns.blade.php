@extends('layouts.app')

@section('title', 'Brave Ad Campaigns and Supported Countries')
@section('description', 'Brave Ad Campaigns and Supported Countries')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">Brave Ads Supported Countries/States</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'ad_campaign_supported_countries', 'unit' => 'day'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">Brave Ads Active Campaigns</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'active_ad_campaigns', 'unit' => 'day'])
            </div>
        </div>
    </div>
    <h1 class="py-2 text-2xl font-semibold">Country-Specific Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Country</th>
                <th class="px-2 py-4 text-left">Number of Active Ad Campaigns</th>
                <th class="px-2 py-4 text-left">Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($campaigns as $campaign)
            <tr>
                <td class="px-2 py-4 border">{{$campaign->country}}</td>
                <td class="px-2 py-4 border">{{$campaign->campaigns}}</td>
                <td class="px-2 py-4 border">
                    <a href="{{route('stats.brave_ads_campaigns', ['country' => $campaign->country])}}"
                        class="text-blue-500">Details</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection