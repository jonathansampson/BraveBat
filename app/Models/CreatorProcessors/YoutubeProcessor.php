<?php

namespace App\Models\CreatorProcessors;

use App\Services\YoutubeService;

class YoutubeProcessor
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
        $service = new YoutubeService();
        $response = $service->getChannel($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->update($response['result']);
            $this->creator->link = "https://www.youtube.com/channel/{$this->creator->channel_id}";
            $this->creator->valid = true;
        } else {
            $this->creator->valid = false;
        }
        $this->creator->save();
    }
}
