@extends('layouts.app')

@section('title', 'BAT Stats')
@section('description', 'BAT Stats: price, volume, holders, and market cap')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <toggleable-line-chart url="/charts/bat_holders_count" title="BAT Addresses">
            </toggleable-line-chart>
        </div>
        <div class="w-full lg:w-1/2">
            <toggleable-line-chart url="/charts/bat_holders_add" title="BAT Addresses Daily Addition">
            </toggleable-line-chart>
        </div>
        <div class="w-full lg:w-1/2">
            <toggleable-line-chart url="/charts/bat_price" title="BAT Daily Price">
            </toggleable-line-chart>
        </div>
        <div class="w-full lg:w-1/2">
            <toggleable-line-chart url="/charts/bat_market_cap" title="BAT Market Cap ($Millions)">
            </toggleable-line-chart>
        </div>
        <div class="w-full lg:w-1/2">
            <toggleable-line-chart url="/charts/bat_volume" title="BAT Daily Trading Volume (Million)">
            </toggleable-line-chart>
        </div>
    </div>
</div>
@endsection