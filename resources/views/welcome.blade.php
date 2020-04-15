@extends('layouts.app')

@section('content')
    <div class='container mx-auto lg:flex lg:flex-wrap'>
        <div class='lg:w-full mb-3' style="max-height: 800px">
            <line-chart 
                colors="{{json_encode(config('bravebat.colors'))}}" 
                identifier="dau"
                title="Brave Browser Daily Active User (Millions)"
                y-title="Daily Active Users"
                x-title="Month"
            >
        </line-chart>

        </div>
        <div class='lg:w-full mb-3' style="max-height: 800px">
            <line-chart 
                colors="{{json_encode(config('bravebat.colors'))}}" 
                identifier="bat_purchase"
                title="Brave-Initiated BAT Purchases for Ad Campaigns"
                y-title="BAT Tokens Purchased"
                x-title="Month"
            >
            </line-chart>
        </div>
    </div>
@endsection