@extends('layouts.app')

@section('title', 'Brave and BAT Communities')
@section('description', 'Brave and BAT Communities: Twitter, Telegram, Reddit and YouTube')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        @foreach (config('bravebat.communities') as $site => $communities)
        @foreach ($communities as $community => $communityID)
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">
                {{community_site_name($site)}}:
                <a href="{{community_link($site, $community)}}" rel="nofollow" target="_blank"
                    class="text-brand-orange">{{community_name($site, $community)}}</a>
            </h1>
            <div class='mb-3 mr-4'>
                <toggleable-line-chart url="{{'/charts/communities/'.$site.'/'.$community}}"></toggleable-line-chart>

                {{-- @include('charts.line', ['id' => 'communities/'.$site.'/'.$community, 'unit' => 'day']) --}}
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection