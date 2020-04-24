<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{
    private $rootUrl = 'https://api.github.com/user/';

    public function getUser($id)
    {
        $response = Http::get($this->rootUrl . $id);
        if (!$response->ok()) {
            return ['success' => false, 'result' => 'User not found'];
        }
        $data = $response->json();

        $name = $data['login'];
        $display_name = $data['name'];
        $thumbnail = $data['avatar_url'];
        $description = $data['bio'];
        $follower_count = $data['followers'];
        $repo_count = $data['public_repos'];
        $link = $data['html_url'];

        return  [
            'success' => true,
            'result' => [
                'name' => $name,
                'display_name' => $display_name,
                'description' => $description,
                'thumbnail' => $thumbnail,
                'follower_count' => $follower_count,
                'repo_count' => $repo_count,
                'link' => $link
            ]
        ];
    }
}
