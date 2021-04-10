<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsAdvertiser;
use Illuminate\Http\Request;

class AdsAdvertisersController extends Controller
{
    public function index()
    {
        $adsAdvertisers = AdsAdvertiser::all();
        return view('ads.advertisers.index', compact('adsAdvertisers'));
    }

    public function show(AdsAdvertiser $adsAdvertiser)
    {
        $adsCampaigns = $adsAdvertiser->adsCampaigns()->orderBy('end_at', 'desc')->get();
        return view('ads.advertisers.show', compact('adsAdvertiser', 'adsCampaigns'));
    }

    public function create()
    {
        return view('ads.advertisers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'required',
        ]);
        AdsAdvertiser::create($request->only('name', 'website'));
        return redirect()->route('ads_advertisers.index');
    }
}
