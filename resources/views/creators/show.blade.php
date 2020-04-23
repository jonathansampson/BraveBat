@extends('layouts.app')

@section('title', "Brave Verified Creator | {$creator->channel} | {$creator->name}")
@section('description', "Brave Verified Creator | {$creator->channel} | {$creator->name}")

@section('content')

<div class='container px-4 py-8 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-col items-center justify-center">
        <h1 class="pb-4 text-3xl">{{$creator->name}}</h1>
        @include('creators.partials.' . $creator->channel)
    </div>
</div>
@endsection
