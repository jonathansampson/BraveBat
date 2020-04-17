<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YoutubeService
{
    private $rootUrl = 'https://www.googleapis.com/youtube/v3/channels?';

    public function getChannel()
    {
        $queryString = http_build_query([
            'part' => 'snippet,contentDetails',
            'id' => 'UCU4SL_90TF_jy2u2yJ7z1vg',
            'key' => 'AIzaSyDFT_Ls76agMcJV8rQiSwSXFco4y9e9VuM'
        ]);
        $response = Http::get($this->rootUrl . $queryString);
        if ($response->ok()) {
            return $response->json();
        }
    }
}
