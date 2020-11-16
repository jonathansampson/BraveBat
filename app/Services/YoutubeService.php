<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class YoutubeService
{
    private $rootUrl = 'https://www.googleapis.com/youtube/v3/channels?';

    public function getChannel($id)
    {
        $queryString = http_build_query([
            'part' => 'snippet,statistics',
            'id' => $id,
            'key' => config('services.youtube.api_key'),
        ]);
        $response = Http::get($this->rootUrl . $queryString);
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        if (empty($response->json()['items'])) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $data = $response->json();
        $name = $data['items'][0]['snippet']['title'];
        $display_name = $data['items'][0]['snippet']['title'];
        $description = Str::limit($data['items'][0]['snippet']['description'], 900);
        if (isset($data['items'][0]['snippet']['thumbnails'])) {
            $thumbnail = $data['items'][0]['snippet']['thumbnails']['default']['url'];
        } else {
            $thumbnail = '';
        }
        $view_count = $data['items'][0]['statistics']['viewCount'];
        $follower_count = isset($data['items'][0]['statistics']['subscriberCount']) ? $data['items'][0]['statistics']['subscriberCount'] : 0;
        $video_count = $data['items'][0]['statistics']['videoCount'];

        return [
            'success' => true,
            'result' => [
                'name' => $name,
                'display_name' => $display_name,
                'description' => $description,
                'thumbnail' => $thumbnail,
                "view_count" => $view_count,
                "follower_count" => $follower_count,
                "video_count" => $video_count,
            ],
        ];
    }
}
