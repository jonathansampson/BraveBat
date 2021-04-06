<?php

namespace App\Http\Controllers;

use App\Models\Ads\AdsCampaign;

class AdsCampaignsController extends Controller
{
    public function index()
    {
        $adsCampaigns = AdsCampaign::with(['adsSets', 'adsGeos', 'adsSets.adsCreatives', 'adsSets.AdsOses', 'adsSets.adsSegments'])->get();
        return view('ads_campaigns.index', compact('adsCampaigns'));
    }

    public function show(AdsCampaign $adsCampaign)
    {
        return view('ads_campaigns.show', compact('adsCampaign'));
    }
}
