@extends('layouts.app')

@section('title', 'Brave Ad Campaigns in ' . $country)
@section('description', 'Brave Ad Campaigns in ' . $country)

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full">
            <toggleable-line-chart url="{{'/charts/active_ad_campaigns?country=' . $country}}"
                title="{{"Brave Active Ads Campaigns in " . $country}}" :toggleable="false">
            </toggleable-line-chart>
        </div>
    </div>
</div>
@endsection