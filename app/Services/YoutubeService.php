<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YoutubeService
{
    private $rootUrl = 'https://www.googleapis.com/youtube/v3/channels?';

    public function getChannel($id)
    {
        $queryString = http_build_query([
            'part' => 'snippet,statistics',
            'id' => $id,
            'key' => config('services.youtube.api_key')
        ]);
        $response = Http::get($this->rootUrl . $queryString);
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        if (empty($response->json()['items'])) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $data = $response->json();
        $title = $data['items'][0]['snippet']['title'];
        $description = $data['items'][0]['snippet']['description'];
        $thumbnail = $data['items'][0]['snippet']['thumbnails']['default']['url'];

        $view_count = $data['items'][0]['statistics']['viewCount'];
        $subscriber_count = $data['items'][0]['statistics']['subscriberCount'];
        $video_count = $data['items'][0]['statistics']['videoCount'];

        return  [
            'success' => true,
            'result' => [
                'title' => $title,
                'description' => $description,
                'thumbnail' => $thumbnail,
                "view_count" => $view_count,
                "subscriber_count" => $subscriber_count,
                "video_count" => $video_count
            ]
        ];
    }
}
