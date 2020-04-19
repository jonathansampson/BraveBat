<?php

namespace App\Models\Creators;

use App\Services\WebsiteService;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use CreatableTrait;

    protected $guarded = [];
    protected $table = 'creator_websites';


    public function httpsUrl()
    {
        return "https://" . $this->name;
    }

    public function httpUrl()
    {
        return "http://" . $this->name;
    }

    public function callApi()
    {
        $this->getAlexaRanking();
        $this->getMetaData();
        $this->getScreenshot();
        if ($this->title || $this->description || $this->screenshot) {
            $this->syncName();
        }
    }

    public function getAlexaRanking()
    {
        $service = new WebsiteService();
        $response = $service->getAlexaRank($this->name);
        if ($response['success']) {
            $this->alexa_ranking = $response['result']['alexa_ranking'];
            $this->save();
        }
    }

    public function getMetaData()
    {
        $https_success = $this->getMetaDataBasedOnUrl($this->httpsUrl());
        if (!$https_success) {
            $this->getMetaDataBasedOnUrl($this->httpUrl());
        }
    }

    public function getMetaDataBasedOnUrl($url)
    {
        $service = new WebsiteService();
        $response = $service->getMetaData($url);
        if ($response['success']) {
            $this->title = $response['result']['title'];
            $this->description = $response['result']['description'];
            $this->save();
            return true;
        }
        return false;
    }

    public function getScreenshot()
    {
        $https_success = $this->getScreenshotBasedOnUrl($this->httpsUrl());
        if (!$https_success) {
            $this->getScreenshotBasedOnUrl($this->httpUrl());
        }
    }

    public function getScreenshotBasedOnUrl($url)
    {
        $service = new WebsiteService();
        $response = $service->getScreenshot($url);
        if ($response['success']) {
            $this->screenshot = $response['result']['screenshot'];
            $this->save();
            return true;
        }
        return false;
    }
}
