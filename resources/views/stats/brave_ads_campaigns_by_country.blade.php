@extends('layouts.app')

@section('title', 'Brave Ad Campaigns in ' . $country)
@section('description', 'Brave Ad Campaigns in ' . $country)

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full">
            <h1 class="py-4 text-2xl font-semibold">Brave Ads Active Campaigns in {{$country}}</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'active_ad_campaigns?country=' . $country, 'unit' => 'day'])
            </div>
        </div>
    </div>
</div>
@endsection