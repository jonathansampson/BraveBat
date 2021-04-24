<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class BraveTransparencyJsonService
{

    protected $data;

    public function __construct()
    {
        $this->data = Http::get('https://brave.com/transparency-data.json')->json();
    }

    public function getBatPurchases()
    {
        $results = [];
        foreach ($this->data['transactions'] as $key => $transaction) {
            $date = Carbon::createFromTimestamp($transaction['date'] / 1000)->toDateString();
            $results[] = [
                'transaction_date' => $date,
                'transaction_amount' => $transaction['BAT'],
                'transaction_record' => $key,
                "transaction_site" => $transaction['site'],
            ];
        }
        return $results;
    }

    public function getAdCampaigns()
    {
        $results = [];
        foreach ($this->data['braveAds'] as $item) {
            $results[] = [
                'country' => $item['name'],
                'campaigns' => $item['count'],
                'record_date' => Carbon::today()->toDateString(),
            ];
        }
        return $results;
    }
}
