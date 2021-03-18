<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BraveCatalogService
{
    protected $data;

    public function __construct()
    {
        $this->data = Http::get(config("bravebat.catelog_page.v3"))->json();
    }

    public function getIssuers()
    {
        return $this->data['issuers'];
    }

    public function getCampaigns()
    {
        return $this->data['campaigns'];
    }

    public function getDayParts()
    {
        $campaigns = $this->data['campaigns'];
        return collect($campaigns)->map(function ($campaign) {
            return $campaign['dayParts'];
        })->toArray();
    }

    public function getGeoTargets()
    {
        $campaigns = $this->data['campaigns'];
        return collect($campaigns)->map(function ($campaign) {
            return $campaign['geoTargets'];
        })->toArray();
    }
}
