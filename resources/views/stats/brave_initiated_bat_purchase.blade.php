@extends('layouts.app')

@section('title', 'Brave Initiated BAT Token Purchase')
@section('description', 'Monthly Brave initiated BAT token purchase to support Brave Browser ad campaigns')

@section('content')
    <div class='container px-4 py-4 mx-auto sm:px-6 md:px-8'>
        <h1 class="py-2 text-2xl font-semibold">Brave Initiated BAT Token Purchase</h1>
        <p class="py-1 text-sm">BAT tokens are routinely purchased with advertiser dollars to support Brave Browser ad campaigns</p>
        <div class='mb-3'>
            <line-chart 
                colors="{{json_encode(config('bravebat.colors'))}}" 
                identifier="bat_purchase"
                title=""
                y-title="BAT Tokens Purchased"
                x-title="Month"
            >
            </line-chart>
        </div>
        <h1 class="py-2 text-2xl font-semibold">Detailed Transaction Data</h1>
        <table class="w-full">
            <thead>
              <tr>
                <th class="px-2 py-4 text-left">Month</th>
                <th class="px-2 py-4 text-left">Tokens Purchased</th>
                <th class="px-2 py-4 text-left">Transaction Record</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                <tr>
                    <td class="px-2 py-4 border">{{$purchase->transaction_date}}</td>
                    <td class="px-2 py-4 border">{{number_format($purchase->transaction_amount)}}</td>
                    <td class="px-2 py-4 border">
                        <a href="https://uphold.com/reserve/transactions/{{$purchase->transaction_record}}" class="text-brand-orange">
                            {{$purchase->transaction_record}}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection