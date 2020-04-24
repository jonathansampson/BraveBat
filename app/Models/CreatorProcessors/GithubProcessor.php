<?php

namespace App\Models\CreatorProcessors;

use App\Services\GithubService;

class GithubProcessor
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
        $service = new GithubService();
        $response = $service->getUser($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->update($response['result']);
            $this->creator->valid = true;
        } else {
            $this->creator->valid = false;
        }
        $this->creator->save();
    }
}
