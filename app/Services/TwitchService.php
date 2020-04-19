<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwitchService
{
    private $access_token;

    public function __construct()
    {
        $this->getAccessToken();
    }

    /**
     * Initiate access token through Twitch API
     *
     * @return void
     */
    public function getAccessToken()
    {
        $queryString = http_build_query([
            'client_id' => config('services.twitch.client_id'),
            'client_secret' => config('services.twitch.client_secret'),
            'grant_type' => 'client_credentials'
        ]);
        $response = Http::post('https://id.twitch.tv/oauth2/token?' . $queryString);
        $this->access_token = $response->json()['access_token'];
    }

    /**
     * Get Twitch user info by combining data from two API endpoint
     *
     * @param string $userLogin
     * @return void
     */
    public function getUser($userLogin)
    {
        $response = Http::withToken($this->access_token)
            ->withHeaders([
                "Client-ID" => config('services.twitch.client_id'),
            ])
            ->get('https://api.twitch.tv/helix/users?login=' . $userLogin);
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        if (empty($response->json()['data'])) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $userInfo = $response->json()['data'][0];
        $twitch_id = $userInfo['id'];
        $name = $userInfo['login'];
        $display_name = $userInfo['display_name'];
        $description = $userInfo['description'];
        $thumbnail = $userInfo['profile_image_url'];
        $view_count = $userInfo['view_count'];
        $response = Http::withToken($this->access_token)
            ->withHeaders([
                "Client-ID" => config('services.twitch.client_id'),
            ])
            ->get('api.twitch.tv/helix/users/follows?to_id=' . $userInfo['id']);
        $follower_count = $response->json()['total'];
        return [
            'success' => true,
            'result' => [
                'twitch_id' => $twitch_id,
                'name' => $name,
                'display_name' => $display_name,
                'description' => $description,
                'thumbnail' => $thumbnail,
                'view_count' => $view_count,
                'follower_count' => $follower_count,
            ]
        ];
    }
}
