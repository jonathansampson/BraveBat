<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VimeoService
{
    private $access_token;
    private $rootUrl = 'https://api.vimeo.com/';

    public function __construct()
    {
        $this->getAccessToken();
    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth(config('services.vimeo.client_id'), config('services.vimeo.client_secret'))
            ->withHeaders([
                "Content-Type" => "application/json",
                "Accept" =>    "application/vnd.vimeo.*+json;version=3.4"
            ])->post($this->rootUrl . 'oauth/authorize/client', [
                'grant_type' => 'client_credentials',
                'scope' => 'public'
            ]);
        $this->access_token = $response['access_token'];
    }

    public function getUser($userId)
    {
        $response = Http::withToken($this->access_token)->get($this->rootUrl . 'users/' . $userId);
        if ($response->ok()) {
            return $response->json();
        }
    }
}
