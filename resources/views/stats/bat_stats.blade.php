@extends('layouts.app')

@section('title', 'BAT Stats')
@section('description', 'BAT Stats: price, volume, holders, and market cap')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">BAT Addresses</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_holders_count', 'unit' => 'day'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">BAT Addresses Daily Addition</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_holders_add', 'unit' => 'day'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">BAT Daily Price</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_price', 'unit' => 'day'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">BAT Market Cap ($Millions)</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_market_cap', 'unit' => 'day'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">BAT Daily Trading Volume (Million)</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_volume', 'unit' => 'day'])
            </div>
        </div>
    </div>
</div>
@endsection
