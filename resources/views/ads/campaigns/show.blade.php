@extends('layouts.app')

@section('title', $adsCampaign->name. " - Brave Advertiser")
@section('description', $adsCampaign->name." is a proud Brave Browser advertiser.")

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
      <div class="flex items-center space-x-1">
        <div>
          Period:
        </div>
        <div>
          {{$adsCampaign->start_at->format('Y-m-d')}} to {{$adsCampaign->end_at->format('Y-m-d')}}
        </div>
      </div>
      <div class="flex items-center space-x-1">
        <div>Segments:</div>
        <div class="space-x-2">
          @foreach ($adsCampaign->segments() as $segment)
          <base-pill-gray-rounded>{{$segment}}</base-pill-gray-rounded>
          @endforeach
        </div>
      </div>
      <div class="flex items-center space-x-1">
        <div>
          Targets:
        </div>
        <div class="space-x-2">
          @foreach ($adsCampaign->oses() as $os)
          <base-pill-gray-rounded>{{$os}}</base-pill-gray-rounded>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div>
    <form action="{{route('ads_campaigns.update', $adsCampaign)}}" method="POST">
      @csrf
      @method('PUT')
      <select class="block w-full mt-1" name="adsAdvertiserId">
        <option value="0">Please Select</option>
        @foreach ($adsAdvertisers as $adsAdvertiser)
        <option value="{{$adsAdvertiser->id}}" @if($adsAdvertiser->id == $adsCampaign->adsAdvertiser?->id)
          selected
          @endif>
          {{$adsAdvertiser->name}}</option>
        @endforeach
      </select>
      <div class="mt-2">
        <base-form-submit-button>Update</base-form-submit-button>
      </div>
    </form>
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