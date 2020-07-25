@extends('layouts.app')

@section('title', 'Brave Initiated BAT Token Purchase')
@section('description', 'Monthly Brave initiated BAT token purchase to support Brave Browser ad campaigns')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">Brave BAT Purchase in BAT</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_purchases'])
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <h1 class="py-4 text-2xl font-semibold">Brave BAT Purchase in Dollar</h1>
            <div class='mb-3'>
                @include('charts.line', ['id' => 'bat_purchases_in_dollars'])
            </div>
        </div>
    </div>
    <h1 class="py-2 text-2xl font-semibold">Detailed Transaction Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Month</th>
                <th class="px-2 py-4 text-left">Tokens Purchased</th>
                <th class="px-2 py-4 text-left">Dollar Amount</th>
                <th class="px-2 py-4 text-left">Transaction Record</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $purchase)
            <tr>
                <td class="px-2 py-4 border">{{$purchase->transaction_date}}</td>
                <td class="px-2 py-4 border">{{number_format($purchase->transaction_amount)}}</td>
                <td class="px-2 py-4 border">${{number_format($purchase->dollar_amount)}}</td>
                <td class="px-2 py-4 border">
                    <a href="{{$purchase->link()}}"
                        class="text-brand-orange">
                        {{$purchase->transaction_record}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection