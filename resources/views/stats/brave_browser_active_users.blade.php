@extends('layouts.app')

@section('title', 'Brave Browser Active Users')
@section('description', 'Monthly Brave Browser active user stats in chart and data table')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <h1 class="py-4 text-2xl font-semibold">Brave Browser Daily Active User (Millions)</h1>
    <div class='mb-3'>
        @include('charts.line', ['id' => 'dau'])
    </div>
    <h1 class="py-2 text-2xl font-semibold">Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Month</th>
                <th class="px-2 py-4 text-left">Daily Active Users</th>
                <th class="px-2 py-4 text-left">Source</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($active_users as $row)
            <tr>
                <td class="px-2 py-4 border">{{$row['month']}}</td>
                <td class="px-2 py-4 border">{{$row['dau'] / 1000000}} Million</td>
                <td class="px-2 py-4 border">
                    @if ($row['source'])
                        <a class="text-blue-500" href="{{$row['source']}}">Source</a>
                    @else 
                        Estimated
                    @endif
                    
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection