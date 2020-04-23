<?php

namespace App\Models\CreatorProcessors;

use App\Services\VimeoService;

class VimeoProcessor
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
        $service = cache()->remember('vimeo_service', 1800, function () {
            return new VimeoService();
        });
        $response = $service->getUser($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->update($response['result']);
            // $this->creator->link = "https://vimeo.com/{$response['result']['name']}"; Link already included in API
            $this->creator->valid = true;
        } else {
            $this->creator->valid = false;
        }
        $this->creator->save();
    }
}
