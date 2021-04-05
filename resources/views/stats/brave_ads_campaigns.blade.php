@extends('layouts.app')

@section('title', 'Brave Ad Campaigns and Supported Countries')
@section('description', 'Brave Ad Campaigns and Supported Countries')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <toggleable-line-chart url="/charts/ad_campaign_supported_countries"
                title="Brave Ads Supported Countries/States">
            </toggleable-line-chart>
        </div>
        <div>
            <toggleable-line-chart url="/charts/active_ad_campaigns" title="Brave Ads Active Campaigns">
            </toggleable-line-chart>
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