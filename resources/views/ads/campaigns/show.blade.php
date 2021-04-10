@extends('layouts.app')

{{-- @section('title', $adsCampaign->name. " - Brave Advertiser")
@section('description', $adsCampaign->name." is a proud Brave Browser advertiser.") --}}

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
  <div class="flex space-x-2 sm:space-x-4">
    <div
      class="flex items-center justify-center w-16 h-16 p-2 border border-gray-100 rounded sm:w-24 sm:h-24 bg-gray-50">
      <img src="//logo.clearbit.com/{{$adsCampaign->adsAdvertiser?->website}}">
    </div>
    <div>
      <div class="text-lg font-bold text-gray-900 sm:text-2xl">
        {{$adsCampaign->adsAdvertiser?->name}}
      </div>
      <div>Campaign ID: {{$adsCampaign->brave_id}}</div>
      <div>Period: {{$adsCampaign->start_at->format('Y-m-d')}} to {{$adsCampaign->end_at->format('Y-m-d')}}</div>
      <div>Segments:
        @foreach ($adsCampaign->segments() as $segment)
        {{$segment}}
        @endforeach
      </div>
      <div>Targets:
        @foreach ($adsCampaign->oses() as $os)
        {{$os}}
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="py-4">
  <x-table.table>
    <thead>
      <x-table.header-cell>Ad Type</x-table.header-cell>
      <x-table.header-cell>Copy Title</x-table.header-cell>
      <x-table.header-cell>Copy Body</x-table.header-cell>
    </thead>
    <x-table.body>
      @foreach ($adsCampaign->creatives() as $creative)
      <tr>
        <x-table.cell>{{$creative['type']}}</x-table.cell>
        <x-table.cell>{{$creative['title']}}</x-table.cell>
        <x-table.cell>{{$creative['body']}}</x-table.cell>
      </tr>
      @endforeach
    </x-table.body>
  </x-table.table>
</div>
@endsection