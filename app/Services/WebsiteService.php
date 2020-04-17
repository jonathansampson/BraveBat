<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WebsiteService
{
    private $rootUrl = 'http://data.alexa.com/data?';

    public function getAlexaRank($website)
    {
        $queryString = http_build_query([
            'cli' => 10,
            'url' => $website,
        ]);
        $response = Http::get($this->rootUrl . $queryString);

        if ($response->ok()) {
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $data = json_decode($json, TRUE);
            return $data['SD']['REACH']['@attributes']['RANK'];
        }
    }

    public function getMetaData($website)
    {
        $page = file_get_contents($website);
        $titleTag = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match);
        if ($titleTag) $title = $match[1];
        $tags = get_meta_tags($website);
        $description = '';
        if (isset($tags['description'])) {
            $description = $tags['description'];
        }
        return [
            'title' => $title,
            'description' => $description
        ];
    }
}
