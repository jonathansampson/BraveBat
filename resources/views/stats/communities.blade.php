@extends('layouts.app')

@section('title', 'Brave and BAT Communities')
@section('description', 'Brave and BAT Communities: Twitter, Telegram, Reddit and YouTube')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2"> @foreach (config('bravebat.communities') as $site =>
        $communities)
        @foreach ($communities as $community => $communityID)
        <div>
            <div class='mb-3 mr-4'>
                <toggleable-line-chart url="{{'/charts/communities/'.$site.'/'.$community}}"
                    title="{{community_site_name($site)}}: <a href='{{community_link($site, $community)}}' rel='nofollow' target='_blank' class='text-brand-orange'>{{community_name($site, $community)}}</a>">
                </toggleable-line-chart>
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection