<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsAdvertiser;
use App\Models\Ads\AdsCampaign;
use Illuminate\Http\Request;

class AdsCampaignsController extends Controller
{
    public function index()
    {
        $adsCampaigns = AdsCampaign::with(['adsSets', 'adsGeos', 'adsAdvertiser', 'adsSets.adsCreatives', 'adsSets.AdsOses', 'adsSets.adsSegments'])->orderBy('ads_advertiser_id')->get();
        return view('ads.campaigns.index', compact('adsCampaigns'));
    }

    public function show(AdsCampaign $adsCampaign)
    {
        $adsAdvertisers = AdsAdvertiser::orderBy('name')->get();
        return view('ads.campaigns.show', compact('adsCampaign', 'adsAdvertisers'));
    }

    public function update(Request $request, AdsCampaign $adsCampaign)
    {
        if ($request->adsAdvertiserId) {
            $adsCampaign->update(['ads_advertiser_id' => $request->adsAdvertiserId]);
        }
        return back();
    }
}
