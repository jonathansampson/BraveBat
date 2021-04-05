@extends('layouts.app')

@section('title', 'Brave Browser Active Users')
@section('description', 'Monthly Brave Browser active user stats in chart and data table')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <toggleable-line-chart url="/charts/dau" title="Brave Browser DAU (M)" :toggleable="false">
            </toggleable-line-chart>
        </div>
        <div>
            <toggleable-line-chart url="/charts/mau" title="Brave Browser MAU (M)" :toggleable="false">
            </toggleable-line-chart>
        </div>
    </div>
    <h1 class="py-2 text-2xl font-semibold">Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Month</th>
                <th class="px-2 py-4 text-left">Daily Active Users</th>
                <th class="px-2 py-4 text-left">Monthly Active Users*</th>
                <th class="px-2 py-4 text-left">Source</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($active_users as $row)
            <tr>
                <td class="px-2 py-4 border">{{$row['month']}}</td>
                <td class="px-2 py-4 border">{{$row['dau'] / 1000000}} Million</td>
                <td class="px-2 py-4 border">
                    @if (isset($row['mau']))
                    {{$row['mau'] / 1000000}} Million
                    @endif
                </td>
                <td class="px-2 py-4 border">
                    @if ($row['source'])
                    <a class="text-brand-orange" href="{{$row['source']}}">Source</a>
                    @else
                    Estimated
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="pt-4 text-sm italic">* The numbers of Monthly Active Users before 2020 are eyeballed from <a
            class="text-brand-orange" href="https://www.youtube.com/watch?v=o8_-5YxUqIQ&t=1666s">a YouTube slide</a></p>
</div>
@endsection