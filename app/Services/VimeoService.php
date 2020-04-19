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
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $data = $response->json();
        $link = $data['link'];
        $name = explode('vimeo.com/', $link)[1];
        $display_name = $data['name'];
        $description = $data['short_bio'];
        $thumbnail = $data['pictures']['sizes'][1]['link'];
        $follower_count = $data['metadata']['connections']['followers']['total'];
        $video_count = $data['metadata']['connections']['videos']['total'];
        return [
            'success' => true,
            'result' => [
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

// array:16 [
//     "uri" => "/users/46924634"
//     "name" => "Raship Trikha"
//     "link" => "https://vimeo.com/rashiptrikha"
//     "location" => "Toronto, ON, Canada"
//     "gender" => ""
//     "bio" => null
//     "short_bio" => "Development Rigging Artist and TD at Jam filled entertainment. I love making CG puppets !"
//     "created_time" => "2015-12-17T23:07:46+00:00"
//     "pictures" => array:5 [
//       "uri" => "/users/46924634/pictures/29342905"
//       "active" => true
//       "type" => "custom"
//       "sizes" => array:9 [
//         0 => array:3 [
//           "width" => 30
//           "height" => 30
//           "link" => "https://i.vimeocdn.com/portrait/29342905_30x30"
//         ]
//         1 => array:3 [
//           "width" => 75
//           "height" => 75
//           "link" => "https://i.vimeocdn.com/portrait/29342905_75x75"
//         ]
//         2 => array:3 [
//           "width" => 100
//           "height" => 100
//           "link" => "https://i.vimeocdn.com/portrait/29342905_100x100"
//         ]
//         3 => array:3 [
//           "width" => 300
//           "height" => 300
//           "link" => "https://i.vimeocdn.com/portrait/29342905_300x300"
//         ]
//         4 => array:3 [
//           "width" => 72
//           "height" => 72
//           "link" => "https://i.vimeocdn.com/portrait/29342905_72x72"
//         ]
//         5 => array:3 [
//           "width" => 144
//           "height" => 144
//           "link" => "https://i.vimeocdn.com/portrait/29342905_144x144"
//         ]
//         6 => array:3 [
//           "width" => 216
//           "height" => 216
//           "link" => "https://i.vimeocdn.com/portrait/29342905_216x216"
//         ]
//         7 => array:3 [
//           "width" => 288
//           "height" => 288
//           "link" => "https://i.vimeocdn.com/portrait/29342905_288x288"
//         ]
//         8 => array:3 [
//           "width" => 360
//           "height" => 360
//           "link" => "https://i.vimeocdn.com/portrait/29342905_360x360"
//         ]
//       ]
//       "resource_key" => "862baa990ab3b9f4c4760293476dd999ef5fd243"
//     ]
//     "websites" => array:2 [
//       0 => array:4 [
//         "name" => "Portfolio"
//         "link" => "https://www.rashiptrikha.com"
//         "type" => "link"
//         "description" => null
//       ]
//       1 => array:4 [
//         "name" => "Instagram"
//         "link" => "https://www.instagram.com/rashiptrikha/"
//         "type" => "instagram"
//         "description" => null
//       ]
//     ]
//     "metadata" => array:1 [
//       "connections" => array:14 [
//         "albums" => array:3 [
//           "uri" => "/users/46924634/albums"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "appearances" => array:3 [
//           "uri" => "/users/46924634/appearances"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "channels" => array:3 [
//           "uri" => "/users/46924634/channels"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "feed" => array:2 [
//           "uri" => "/users/46924634/feed"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//         ]
//         "followers" => array:3 [
//           "uri" => "/users/46924634/followers"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 165
//         ]
//         "following" => array:3 [
//           "uri" => "/users/46924634/following"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 15
//         ]
//         "groups" => array:3 [
//           "uri" => "/users/46924634/groups"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "likes" => array:3 [
//           "uri" => "/users/46924634/likes"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 2
//         ]
//         "membership" => array:2 [
//           "uri" => "/users/46924634/membership/"
//           "options" => array:1 [
//             0 => "PATCH"
//           ]
//         ]
//         "moderated_channels" => array:3 [
//           "uri" => "/users/46924634/channels?filter=moderated"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 1
//         ]
//         "portfolios" => array:3 [
//           "uri" => "/users/46924634/portfolios"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "videos" => array:3 [
//           "uri" => "/users/46924634/videos"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 32
//         ]
//         "shared" => array:3 [
//           "uri" => "/users/46924634/shared/videos"
//           "options" => array:1 [
//             0 => "GET"
//           ]
//           "total" => 0
//         ]
//         "pictures" => array:3 [
//           "uri" => "/users/46924634/pictures"
//           "options" => array:2 [
//             0 => "GET"
//             1 => "POST"
//           ]
//           "total" => 1
//         ]
//       ]
//     ]
//     "location_details" => array:10 [
//       "formatted_address" => "Toronto, ON, Canada"
//       "latitude" => 43.6532249
//       "longitude" => -79.3831863
//       "city" => "Toronto"
//       "state" => "Ontario"
//       "neighborhood" => null
//       "sub_locality" => null
//       "state_iso_code" => "ON"
//       "country" => "Canada"
//       "country_iso_code" => "CA"
//     ]
//     "skills" => []
//     "available_for_hire" => false
//     "resource_key" => "f9ea8188b5182721de338acec4371c9bfdeda631"
//     "account" => "basic"
//   ]
