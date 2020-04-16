@extends('layouts.app')

@section('title', 'Resource on Brave Browser, BAT and Beyond')
@section('description', 'Your comprehensive resource on Brave Browser, Basic Attention Token and their passionate communities')

@section('content')
    <div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
        <div class='mb-3' style="">
            <line-chart 
                colors="{{json_encode(config('bravebat.colors'))}}" 
                identifier="dau"
                title="Brave Browser Daily Active User (Millions)"
                y-title="Daily Active Users"
                x-title="Month"
            >
        </line-chart>
        </div>
        <div class='mb-3' style="">
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