<?php

namespace App\Http\Controllers;

use App\Models\BatPurchase;
use Illuminate\Http\Request;
use App\Models\BraveUsage;

class StatsController extends Controller
{
    public function brave_browser_active_users()
    {
        $active_users = BraveUsage::all();
        return view('stats.brave_browser_active_users', compact('active_users'));
    }
    public function brave_initiated_bat_purchase()
    {
        $purchases = BatPurchase::all();
        dump($purchases);
        return view('stats.brave_initiated_bat_purchase', compact('purchases'));
    }
}
