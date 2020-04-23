<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
        $this->access_token = Cache::remember('vimeo_access_token', 3600, function () {
            $response = Http::withBasicAuth(config('services.vimeo.client_id'), config('services.vimeo.client_secret'))
                ->withHeaders([
                    "Content-Type" => "application/json",
                    "Accept" =>    "application/vnd.vimeo.*+json;version=3.4"
                ])->post($this->rootUrl . 'oauth/authorize/client', [
                    'grant_type' => 'client_credentials',
                    'scope' => 'public'
                ]);
            echo 'I am here';
            return  $response['access_token'];
        });
        echo $this->access_token;
    }

    public function getUser($userId)
    {
        $response = Http::withToken($this->access_token)->get($this->rootUrl . 'users/' . $userId);
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $data = $response->json();
        $link = $data['link'];
        $name = $data['name'];
        $display_name = $data['name'];
        $description = $data['short_bio'];
        $thumbnail = $data['pictures']['sizes'][1]['link'];
        $follower_count = $data['metadata']['connections']['followers']['total'];
        $video_count = $data['metadata']['connections']['videos']['total'];
        return [
            'success' => true,
            'result' => [
                'link' => $link,
                'name' => $name,
                'display_name' => $display_name,
                'description' => $description,
                'thumbnail' => $thumbnail,
                'follower_count' => $follower_count,
                'video_count' => $video_count,
            ]
        ];
    }
}
