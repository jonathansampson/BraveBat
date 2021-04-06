@extends('layouts.app-no-search')

@section('title', "{$channel} creators")
@section('description', "Find your favorite creators among the {$count} {$channel} creators")

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 md:px-8">
    <div class="flex items-center justify-center text-2xl">
        <div class="w-8 h-8 mr-2">
            @includeIf('partials.icons.'.$channel)
        </div>
        <div>
            {{number_format($count)}} Creators
        </div>
    </div>
    <channel-search channel="{{$channel}}" :count="{{$count}}"></channel-search>
</div>
@endsection