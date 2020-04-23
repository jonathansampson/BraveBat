@extends('layouts.app')

@section('title', 'Brave Verified Creators - Websites')
@section('description', 'Brave Verified Creators - Websites')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div>
        <h1 class="inline-block py-2 text-2xl font-semibold ">Website Creators</h1>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-2 py-4 text-left">Website</th>
                    <th class="px-2 py-4 text-left">Alexa Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($websites as $key => $website)
                <tr>

                    <td class="px-2 py-4 border">
                        <a 
                            href="{{route('creators.show', [$website->channel, $website->id])}}"
                            class="text-blue-500"
                            >
                            {{$website->name}}
                        </a>
                    </td>
                    <td class="px-2 py-4 border">
                       {{$website->alexa_ranking}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-col items-center justify-between my-6">
            <div class="hidden md:block">
                {{$websites->links()}}
            </div>
            <div class="block md:hidden">
                {{$websites->links('vendor.pagination.simple-default')}}
            </div>
        </div>
    </div>
</div>
@endsection
