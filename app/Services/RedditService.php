<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RedditService
{
    public function getSubreddit($subreddit)
    {
        $url = "https://www.reddit.com/r/{$subreddit}/about.json";
        $response = Http::withHeaders(['User-Agent' => 'My Bot'])->get($url);
        if ($response->ok()) {
            return [
                'success' => true,
                'result' => [
                    'subscribers' => $response->json()['data']['subscribers']
                ]
            ];
        }
    }
}
