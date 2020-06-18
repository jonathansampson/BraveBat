<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class EthplorerService
{
    /**
     * Get BAT token info from Ethplorer API
     *
     * @return void
     */
    public function getStats()
    {
        $rootUrl = 'https://api.ethplorer.io/getAddressInfo/';
        $url = $rootUrl . config('services.ethplorer.bat_token_address') . '?apiKey=' . config('services.ethplorer.api_key');

        $response = Http::get($url);
        if ($response->ok()) {
            $data = $response->json()['tokenInfo'];
            return  [
                'success' => true,
                'result' => [
                    'holders_count' => $data['holdersCount'],
                    'price' => $data['price']['rate'],
                    'volume' => $data['price']['volume24h'],
                    'market_cap' => $data['price']['marketCapUsd'],
                ]
            ];
        }
    }
}
