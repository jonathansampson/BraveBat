<?php

namespace App\Models\CreatorProcessors;

use App\Services\WebsiteService;

class WebsiteProcessor
{
    protected $creator;

    public function __construct($creator)
    {
        $this->creator = $creator;
    }

    public function process()
    {
        $this->getAlexaRanking();
    }

    public function getAlexaRanking()
    {
        $service = new WebsiteService();
        $response = $service->getAlexaRank($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->alexa_ranking = $response['result']['alexa_ranking'];
        } else {
            $this->creator->alexa_ranking = 10000000;
        }
        $this->creator->link = "https://" . $this->creator->channel_id;
        $this->creator->name = $this->creator->channel_id;
        $this->creator->valid = true;
        $this->creator->save();
    }

}
