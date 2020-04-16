<?php

namespace App\Http\Controllers;

use App\Models\BraveUsage;
use DB;

class ChartDataController extends Controller
{
    public function dau()
    {
        $data = BraveUsage::all();
        $labels = collect($data)->map(fn ($item) => $item['month']);
        $dau = collect($data)->map(fn ($item) => round(($item['dau'] / 1000000), 1));
        return [
            'labels' => $labels,
            'data' => [
                'Daily Active Users' => $dau
            ]
        ];
    }

    public function batPurchases()
    {
        $data = DB::select("SELECT 
            DATE_FORMAT(transaction_date, '%Y-%m') AS month,
            sum(transaction_amount) AS bat_tokens
        FROM
            bat_purchases
        GROUP BY
            month
        ORDER BY
            month");
        $labels = collect($data)->map(fn ($item) => $item->month);
        $bat_tokens = collect($data)->map(fn ($item) => $item->bat_tokens);

        return [
            'labels' => $labels,
            'data' => [
                'BAT Tokens Purchased' => $bat_tokens
            ]
        ];
    }

    public function adCampaignSupportedCountries()
    {
        $data = DB::select("SELECT
            DATE_FORMAT(record_date, '%Y-%m') AS month,
            max(countries) AS countries
        FROM (
            SELECT
                record_date,
                count(campaigns) AS countries
            FROM
                brave_ad_campaigns
            GROUP BY
                record_date
            ORDER BY
                record_date) t
        GROUP BY
            month
        ORDER BY
            month");
        $labels = collect($data)->map(fn ($item) => $item->month);
        $countries = collect($data)->map(fn ($item) => $item->countries);

        return [
            'labels' => $labels,
            'data' => [
                'Number of Supported Countries' => $countries
            ]
        ];
    }

    public function activeAdCampaigns()
    {
        $data = DB::select("SELECT
            DATE_FORMAT(record_date, '%Y-%m') AS month,
            max(campaigns) AS campaigns
        FROM (
            SELECT
                record_date,
                sum(campaigns) AS campaigns
            FROM
                brave_ad_campaigns
            GROUP BY
                record_date
            ORDER BY
                record_date) t
        GROUP BY
            month
        ORDER BY
            month");
        $labels = collect($data)->map(fn ($item) => $item->month);
        $campaigns = collect($data)->map(fn ($item) => $item->campaigns);

        return [
            'labels' => $labels,
            'data' => [
                'Number of Active Campaigns' => $campaigns
            ]
        ];
    }
}
