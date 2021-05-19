@extends('layouts.app')

@section('title', 'Brave Initiated BAT Token Purchase')
@section('description', 'Monthly Brave initiated BAT token purchase to support Brave Browser ad campaigns')

@section('content')
<div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div>
            <toggleable-line-chart url="/charts/bat_purchases" title="Brave-Initiated BAT Purchase in BAT"
                :toggleable="false">
            </toggleable-line-chart>
        </div>
        <div>
            <toggleable-line-chart url="/charts/bat_purchases_in_dollars"
                title="Brave-Initiated BAT Purchase in Dollars ($)" :toggleable="false">
            </toggleable-line-chart>
        </div>
    </div>
    <h1 class="py-2 text-2xl font-semibold">Detailed Transaction Data</h1>
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-4 text-left">Date</th>
                <th class="px-2 py-4 text-left">Tokens Purchased</th>
                <th class="px-2 py-4 text-left">Dollar Amount*</th>
                <th class="px-2 py-4 text-left">Site</th>
                <th class="px-2 py-4 text-left">Transaction Record</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchases as $purchase)
            <tr>
                <td class="px-2 py-4 border">{{$purchase->transaction_date}}</td>
                <td class="px-2 py-4 border">{{number_format($purchase->transaction_amount)}}</td>
                <td class="px-2 py-4 border">${{number_format($purchase->dollar_amount)}}</td>
                <td class="px-2 py-4 border">{{$purchase->transaction_site}}</td>
                <td class="px-2 py-4 border">
                    @if ($purchase->transaction_site == "Uphold")
                    <a href="{{$purchase->link()}}" class="text-brand-orange">
                        {{$purchase->transaction_record}}
                    </a>
                    @else
                    {{$purchase->transaction_record}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="pt-4 text-sm italic">* The Dollar Amount from Uphold purchase is from the Uphold transaction record.
        The Dollar Amount from Coinbase purchase is calculated based on the BAT price on the day of the purchase.</p>
</div>
@endsection
