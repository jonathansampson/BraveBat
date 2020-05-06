@extends('layouts.app')

@section('title', 'Brave Creator Historical Growth')
@section('description', 'Brave Creator Historical Monthly Growth since 2018')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <h1 class="py-4 text-2xl font-semibold">Total Brave Creators</h1>
    <div class='mb-3'>
        @include('charts.line', ['id' => 'creator_stats'])
    </div>
    <h1 class="py-2 text-2xl font-semibold">Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Month</th>
                <th class="px-2 py-4 text-left">Estimated Total Brave Creators</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($creator_stats as $creator_stat)
            <tr>
                <td class="px-2 py-4 border">{{$creator_stat->record_date->format('Y-m')}}</td>
                <td class="px-2 py-4 border">{{number_format($creator_stat->verified_creators/1000)}}K</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection