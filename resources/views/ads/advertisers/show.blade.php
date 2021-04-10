@extends('layouts.app')

@section('title', $adsAdvertiser->name. " - Brave Advertiser")
@section('description', $adsAdvertiser->name." is a proud Brave Browser advertiser.")

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
  <div class="flex space-x-2 sm:space-x-4">
    <div
      class="flex items-center justify-center w-16 h-16 p-2 border border-gray-100 rounded sm:w-24 sm:h-24 bg-gray-50">
      <img src="//logo.clearbit.com/{{$adsAdvertiser->website}}">
    </div>
    <div>
      <div class="text-lg font-bold text-gray-900 sm:text-2xl">
        {{$adsAdvertiser->name}}
      </div>
      <div>
        <a href="{{$adsAdvertiser->website()}}">{{$adsAdvertiser->website()}}</a>
      </div>
    </div>
  </div>
</div>
<div class="pb-4">
  <x-table.table>
    <thead>
      <x-table.header-cell>Progress</x-table.header-cell>
      <x-table.header-cell>Start</x-table.header-cell>
      <x-table.header-cell>End</x-table.header-cell>
      <x-table.header-cell></x-table.header-cell>
    </thead>
    <x-table.body>
      @foreach ($adsCampaigns as $adsCampaign)
      <x-table.cell>
        @if ($adsCampaign->notStarted())
        Not started
        @endif
        @if ($adsCampaign->finished())
        Completed
        @endif
        @if (!$adsCampaign->finished() && !$adsCampaign->notStarted())
        <div class="flex h-2 overflow-hidden text-xs bg-orange-200 rounded">
          <div style="width:{{$adsCampaign->progress()}}%"
            class="flex flex-col justify-center text-center text-white shadow-none bg-brand-orange whitespace-nowrap">
          </div>
        </div>
        @endif
      </x-table.cell>
      <x-table.cell>{{$adsCampaign->start_at->format('Y-m-d')}}</x-table.cell>
      <x-table.cell>{{$adsCampaign->end_at->format('Y-m-d')}}</x-table.cell>
      <x-table.cell class="text-right">
        <base-link-button-orange-rounded href="{{route('ads_campaigns.show', $adsCampaign)}}"
          class="px-2 text-xs sm:px-3 sm:py-1 sm:text-sm">
          Details
        </base-link-button-orange-rounded>
      </x-table.cell>
      </tr>
      @endforeach
    </x-table.body>
  </x-table.table>
</div>
@endsection