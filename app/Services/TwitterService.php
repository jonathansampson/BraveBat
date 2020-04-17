<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwitterService
{
    private $access_token;
    private $rootUrl = 'https://api.twitter.com/';

    public function __construct()
    {
        $this->getAccessToken();
    }

    public function getAccessToken()
    {
        $curl = curl_init();
        $auth = base64_encode(config('services.twitter.client_id') . ':' . config('services.twitter.client_secret'));
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . "oauth2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic " . $auth,
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $this->access_token = json_decode($response)->access_token;
    }

    public function getUser($userHandle)
    {
        $response = Http::withToken($this->access_token)->get('https://api.twitter.com/1.1/users/show.json?screen_name=' . $userHandle);
        if ($response->ok()) {
            return $response->json();
        }
    }
}
