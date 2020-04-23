@extends('layouts.app')

@section('title', 'Brave Verified Creators - ' . $channel_info["creator_title"])
@section('description', 'Brave Verified Creators - ' .$channel_info["creator_title"])

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div>
        <h1 class="inline-block py-2 text-2xl font-semibold ">{{$channel_info['creator_title']}} </h1>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-2 py-4 text-left">Name</th>
                    <th class="px-2 py-4 text-left">{{$channel_info['rank_column_title']}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($creators as $key => $creator)
                <tr>

                    <td class="px-2 py-4 border">
                        <a 
                            href="{{route('creators.show', [$creator->channel, $creator->id])}}"
                            class="text-blue-500"
                            >
                            {{$creator->name}}
                        </a>
                    </td>
                    <td class="px-2 py-4 border">
                       {{ number_format($creator->{$column}) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center justify-between my-6">
            <div class="hidden md:block">
                {{$creators->links()}}
            </div>
            <div class="block md:hidden">
                {{$creators->links('vendor.pagination.simple-default')}}
            </div>
        </div>
    </div>
</div>
@endsection
