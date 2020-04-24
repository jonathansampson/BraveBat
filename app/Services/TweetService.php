<?php

namespace App\Services;

use TwitterAPIExchange;

class TweetService
{
    protected $twitter;

    public function __construct()
    {
        $settings = array(
            'oauth_access_token' => config('services.twitter.access_token'),
            'oauth_access_token_secret' => config('services.twitter.access_token_secret'),
            'consumer_key' => config('services.twitter.client_id'),
            'consumer_secret' => config('services.twitter.client_secret'),
        );
        $this->twitter = new TwitterAPIExchange($settings);
    }

    public function postTweet($message)
    {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';
        $postfields = ['status' => $message];
        $response = $this->twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postfields)
            ->performRequest();
        $response = json_decode($response);
        if (property_exists($response, 'errors')) {
            return false;
        } else {
            return true;
        }
    }
}
