<?php

namespace App\Models\Creators;

use App\Services\WebsiteService;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $guarded = [];

    protected $table = 'creator_websites';

    /**
     * Get the creator
     */
    public function creator()
    {
        return $this->morphOne('App\Models\Creator', 'creatable');
    }

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
        $service = new WebsiteService();
        $response = $service->getMetaData($this->httpsUrl());
        if ($response['success']) {
            $this->title = $response['result']['title'];
            $this->description = $response['result']['description'];
            $this->save();
        }
    }

    public function getScreenshot()
    {
        $service = new WebsiteService();
        $response = $service->getScreenshot($this->httpsUrl());
        if ($response['success']) {
            $this->screenshot = $response['result']['screenshot'];
            $this->save();
        }
    }
}
