<?php

namespace App\Models\CreatorProcessors;

use App\Services\TwitterService;

class TwitterProcessor
{
    protected $creator;

    public function __construct($creator)
    {
        $this->creator = $creator;
    }

    public function process()
    {
        $this->callApi();
        $this->creator->touch();
    }

    public function callApi()
    {
        $service = cache()->remember('twitter_service', 1800, function () {
            return new TwitterService();
        });
        $response = $service->getUser($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->update($response['result']);
            $this->creator->link = "https://twitter.com/{$response['result']['name']}";
            $this->creator->valid = true;
        } else {
            $this->creator->valid = false;
        }
        $this->creator->save();
    }
}
