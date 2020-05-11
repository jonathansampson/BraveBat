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
        $this->getScreenshot();
    }

    public function getAlexaRanking()
    {
        $service = new WebsiteService();
        $response = $service->getAlexaRank($this->creator->channel_id);
        if ($response['success']) {
            $this->creator->alexa_ranking = $response['result']['alexa_ranking'];
            $this->creator->save();
        } else {
            $this->creator->alexa_ranking = 10000000;
            $this->creator->save();
        }
    }

    public function httpsUrl()
    {
        return "https://" . $this->creator->channel_id;
    }

    public function httpUrl()
    {
        return "http://" . $this->creator->channel_id;
    }

    public function httpsWwwUrl()
    {
        return "https://www." . $this->creator->channel_id;
    }

    public function getScreenshot()
    {
        $https_screenshot = $this->getScreenshotBasedOnUrl($this->httpsUrl());
        if ($https_screenshot) return;

        $http_screenshot = $this->getScreenshotBasedOnUrl($this->httpUrl());
        if ($http_screenshot) return;

        $https_www_screenshot = $this->getScreenshotBasedOnUrl($this->httpsWwwUrl());
        if ($https_www_screenshot) return;

        $this->creator->link = $this->creator->channel_id;
        $this->creator->name = $this->creator->channel_id;
        $this->creator->valid = true;
        $this->creator->save();
    }

    public function getScreenshotBasedOnUrl($url)
    {
        $service = new WebsiteService();
        $response = $service->getScreenshot($url);
        if ($response['success']) {
            $this->creator->screenshot = $response['result']['screenshot'];
            $this->creator->link = $url;
            $this->creator->valid = true;
            $this->creator->name = $this->creator->channel_id;
            $this->creator->save();
            return true;
        }
        return false;
    }
}
