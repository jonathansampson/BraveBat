<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsCampaign;

class AdsCampaignsController extends Controller
{
    public function index()
    {
        $adsCampaigns = AdsCampaign::with(['adsSets', 'adsGeos', 'adsAdvertiser', 'adsSets.adsCreatives', 'adsSets.AdsOses', 'adsSets.adsSegments'])->get();
        return view('ads.campaigns.index', compact('adsCampaigns'));
    }

    public function show(AdsCampaign $adsCampaign)
    {
        return view('ads.campaigns.show', compact('adsCampaign'));
    }
}
