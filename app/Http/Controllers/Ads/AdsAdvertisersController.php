<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsAdvertiser;

class AdsAdvertisersController extends Controller
{
    public function index()
    {
        return view('ads.advertisers.index');
    }

    public function show(AdsAdvertiser $adsAdvertiser)
    {
        $adsCampaigns = $adsAdvertiser->adsCampaigns()->orderBy('end_at', 'desc')->get();
        return view('ads.advertisers.show', compact('adsAdvertiser', 'adsCampaigns'));
    }

}
