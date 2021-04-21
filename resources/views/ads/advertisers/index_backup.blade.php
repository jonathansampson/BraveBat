@extends('layouts.app')

@section('title', "Brave Advertisers")
@section('description', 'A list of all advertisers on Brave Browser')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
  <div class="grid grid-cols-2 gap-2 sm:gap-6 lg:grid-cols-4">
    @foreach ($adsAdvertisers as $adsAdvertiser)
    <a class="flex items-center p-2 border border-gray-100 rounded shadow-sm bg-gray-50 sm:p-5 hover:bg-gray-100"
      href="{{route('ads_advertisers.show', $adsAdvertiser)}}">
      <div class="flex items-center space-x-2 sm:space-x-4">
        <div>
          <div class="flex items-center justify-center w-8 h-8 sm:w-12 sm:h-12 ">
            <img src="//logo.clearbit.com/{{$adsAdvertiser->website}}">
          </div>
        </div>
        <div>
          <div class="text-lg font-bold text-gray-900 sm:text-xl md:text-2xl">
            <p class="">{{$adsAdvertiser->name}}</p>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
  <div class="mt-4">
    <base-link-button-orange-rounded href="{{route('ads_advertisers.create')}}" class="px-3 py-1">Create
    </base-link-button-orange-rounded>
  </div>
</div>

@endsection