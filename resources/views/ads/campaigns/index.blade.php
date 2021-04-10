@extends('layouts.app')

@section('title', "Brave Ads Campaigns")
@section('description', 'A list of Brave ads campaigns')

@section('content')
<div class="py-4">
  <x-table.table>
    <thead>
      <x-table.header-cell>Id</x-table.header-cell>
      <x-table.header-cell>Start</x-table.header-cell>
      <x-table.header-cell>End</x-table.header-cell>
      <x-table.header-cell>Daily Cap</x-table.header-cell>
      <x-table.header-cell>PTR</x-table.header-cell>
      <x-table.header-cell>Priority</x-table.header-cell>
      <x-table.header-cell>URL</x-table.header-cell>
      <x-table.header-cell>Copy Title</x-table.header-cell>
      <x-table.header-cell>Copy Body</x-table.header-cell>
      <x-table.header-cell>Company</x-table.header-cell>
      <x-table.header-cell></x-table.header-cell>
    </thead>
    <x-table.body>
      @foreach ($adsCampaigns as $adsCampaign)
      <tr>

        <x-table.cell>{{$adsCampaign->id}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->start_at->format('Y-m-d')}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->end_at->format('Y-m-d')}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->daily_cap}}</x-table.cell>
        <x-table.cell>{{number_format($adsCampaign->ptr, 2)}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->priority}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->landingUrl()}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->copyTitle()}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->copyBody()}}</x-table.cell>
        <x-table.cell>{{$adsCampaign->adsAdvertiser?->name}}</x-table.cell>
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