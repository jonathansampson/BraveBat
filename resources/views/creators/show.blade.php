@extends('layouts.app')

@section('title', "Brave Verified Creator | {$creator->channel} | {$creator->name}")
@section('description', "Brave Verified Creator | {$creator->channel} | {$creator->name}")

@section('content')

<div class='container px-4 py-8 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-col items-center justify-center">
        <h1 class="pb-4 text-3xl">{{$creator->name}}</h1>
        @include('creators.partials.' . $creator->channel)
        <h1 class="py-8 text-3xl">Support Brave Creator</h1>
        <div class="flex items-center justify-center">
            <x-download-badge></x-download-badge>
        </div>
    </div>
</div>
@endsection
