<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Ads\AdsAdvertiser;
use Illuminate\Http\Request;

class AdsAdvertisersApiController extends Controller
{
    public function index()
    {
        $adsAdvertisers = AdsAdvertiser::orderBy('id', 'desc')->get();
        return $adsAdvertisers;
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
