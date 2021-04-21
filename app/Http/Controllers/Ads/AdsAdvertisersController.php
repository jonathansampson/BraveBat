<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsAdvertiser;
use Illuminate\Http\Request;

class AdsAdvertisersController extends Controller
{
    public function index()
    {
        $adsAdvertisers = AdsAdvertiser::orderBy('id', 'desc')->get();
        if (request()->wantsJson()) {
            return $adsAdvertisers;
        }
        return view('ads.advertisers.index');
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
            'name' => ['required', 'max:255'],
            'website' => ['required', 'max:255', 'url'],
        ]);
        $adsAdvertiser = AdsAdvertiser::create($request->only('name', 'website'));
        return $adsAdvertiser;
    }

    public function destroy(AdsAdvertiser $adsAdvertiser)
    {
        $adsAdvertiser->delete();
    }
}
