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

    public function link()
    {
        return "https://" . $this->name;
    }

    public function callApi()
    {
        $this->getAlexaRanking();
        $this->getScreenshot();
        if ($this->screenshot) {
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

    public function getScreenshot()
    {
        $https_success = $this->getScreenshotBasedOnUrl($this->httpsUrl());
        if (!$https_success) {
            $this->getScreenshotBasedOnUrl($this->httpUrl());
            $this->https = false;
            $this->save();
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

    public static function rank()
    {
        self::whereNull('alexa_ranking')->get()->each(function ($item) {
            $item->alexa_ranking = 10000000;
            $item->save();
        });
        $creatables = self::whereNotNull('screenshot')->orderBy('alexa_ranking', 'asc')->get();
        $fraction = 1 / $creatables->count();
        foreach ($creatables as $index => $creatable) {
            $creator = $creatable->creator;
            $creator->rank = $index * $fraction;
            $creator->save();
        }
    }
}
