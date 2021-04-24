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
                    'subscribers' => $response->json()['data']['subscribers'],
                ],
            ];
        }
    }

    /**
     * Initiate access token through Reddit API
     *
     * @return void
     */
    public function getAccessToken()
    {
        $response = Http::withBasicAuth('2JcKAdFG8-cU3w', 'X2kXD9B_ttQHaZrdCaskBLiu3Rnetw')->post("https://www.reddit.com/api/v1/access_token?grant_type=client_credentials&scope=privatemessages");
        return $response->json()['access_token'];
    }

    // I cannot find a way to retrieve user info from Reddit ID through Reddit API. Future research might be needed

}
