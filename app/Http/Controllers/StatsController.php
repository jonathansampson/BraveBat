<?php

namespace App\Http\Controllers;

use App\Models\BatPurchase;
use App\Models\BraveAdCampaign;
use App\Models\BraveUsage;
use App\Models\Stats\CreatorStats;
use Illuminate\Http\Request;

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

    public function brave_ads_campaigns(Request $request)
    {
        $country = $request->country;
        if ($country) {
            $campaigns = BraveAdCampaign::where('country', $country)->get();
            return view('stats.brave_ads_campaigns_by_country', compact('campaigns', 'country'));
        } else {
            $latest = BraveAdCampaign::orderBy('record_date', 'desc')->first();
            if ($latest) {
                $campaigns = BraveAdCampaign::where('record_date', $latest->record_date)->get();
                return view('stats.brave_ads_campaigns', compact('campaigns'));
            } else {
                abort(500);
            }
        }
    }

    public function brave_creator_historical_stats()
    {
        $creator_stats = CreatorStats::orderBy('record_date', 'desc')->get();
        return view('stats.brave_creator_historical_stats', compact('creator_stats'));
    }

    public function bat_stats()
    {
        return view('stats.bat_stats');
    }

    public function top_creators()
    {
        return view('stats.top_creators');
    }

    public function creator_validation()
    {
        $channels = [
            'youtube' => 'Invalid YouTube Creator (%)',
            'twitch' => 'Invalid Twitch Creator (%)',
            'twitter' => 'Invalid Twitter Creator (%)',
            'vimeo' => 'Invalid Vimeo Creator (%)',
            'github' => 'Invalid GitHub Creator (%)',
        ];
        return view('stats.creator_validation', compact('channels'));
    }

    public function communities()
    {
        return view('stats.communities');
    }
}
