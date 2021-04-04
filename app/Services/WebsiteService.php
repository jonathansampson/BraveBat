<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WebsiteService
{
    public function getAlexaRank($website)
    {
        try {
            $queryString = http_build_query([
                'cli' => 10,
                'url' => $website,
            ]);
            $url = 'http://data.alexa.com/data?' . $queryString;
            $response = Http::get($url);
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $data = json_decode($json, true);
            if (isset($data['SD'])) {
                $alexa_ranking = $data['SD']['REACH']['@attributes']['RANK'];
                return [
                    'success' => true,
                    'result' => [
                        'alexa_ranking' => $alexa_ranking,
                    ],
                ];
            } else {
                return ['success' => false, 'result' => 'Invalid website or alexa ranking too low'];
            }
        } catch (\Exception$e) {
            return ['success' => false, 'result' => 'API error'];
        }
    }
}
