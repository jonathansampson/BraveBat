<?php

namespace App\Http\Controllers;

use App\Models\BatPurchase;
use App\Models\BraveUsage;
use App\Models\BraveAdCampaign;
use App\Models\Stats\CreatorStats;

class StatsController extends Controller
{
    public function brave_browser_active_users()
    {
        $active_users = BraveUsage::all();
        return view('stats.brave_browser_active_users', compact('active_users'));
    }

    public function brave_initiated_bat_purchase()
    {
        $purchases = BatPurchase::orderBy('transaction_date', 'desc')->get();
        return view('stats.brave_initiated_bat_purchase', compact('purchases'));
    }

    public function brave_ads_campaigns()
    {
        $latest = BraveAdCampaign::orderBy('record_date', 'desc')->first();
        if ($latest) {
            $campaigns = BraveAdCampaign::where('record_date', $latest->record_date)->get();
            return view('stats.brave_ads_campaigns', compact('campaigns'));
        } else {
            abort(500);
        }
    }

    public function brave_creator_historical_stats()
    {
        $creator_stats = CreatorStats::orderBy('record_date', 'desc')->get();
        return view('stats.brave_creator_historical_stats', compact('creator_stats'));
    }
}
