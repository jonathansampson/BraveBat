<?php

namespace App\Models\CreatorProcessors;

use App\Services\TwitchService;

class TwitchProcessor
{
    protected $creator;

    public function __construct($creator)
    {
        $this->creator = $creator;
    }

    public function process()
    {
        $this->callApi();
    }

    public function callApi()
    {
        $service = cache()->remember('twitch_service', 1800, function () {
            return new TwitchService();
        });
        $response = $service->getUser($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->update($response['result']);
            $this->creator->link = "https://www.twitch.tv/{$response['result']['name']}";
            $this->creator->valid = true;
        } else {
            $this->creator->valid = false;
        }
        $this->creator->save();
    }
}
