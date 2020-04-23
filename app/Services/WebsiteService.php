<?php

namespace App\Services;

use Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
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
            $data = json_decode($json, TRUE);
            if (isset($data['SD'])) {
                $alexa_ranking = $data['SD']['REACH']['@attributes']['RANK'];
                return [
                    'success' => true,
                    'result' => [
                        'alexa_ranking' => $alexa_ranking
                    ]
                ];
            } else {
                return ['success' => false, 'result' => 'Invalid website or alexa ranking too low'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'result' => 'API error'];
        }
    }

    public function getScreenshot($website)
    {
        try {
            $host = parse_url($website)['host'];
            $filename = 'website_screenshots/' . str_replace(".", "_", $host) . '.png';
            Browsershot::url($website)
                ->waitUntilNetworkIdle()
                ->device('iPhone X')
                ->dismissDialogs()
                ->save(storage_path('app/temp.png'));

            $contents = Storage::disk('local')->get('temp.png');
            Storage::put($filename, $contents, 'public');
            return [
                'success' => true,
                'result' => [
                    'screenshot' => $filename,
                ]
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'result' => 'Invalid website'];
        }
    }
}
