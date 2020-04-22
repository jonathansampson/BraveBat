<?php

namespace App\Http\Controllers;

use DB;
use App\Models\BraveUsage;

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
            -- DATE_FORMAT(record_date, '%Y-%m') AS month,
            DATE_FORMAT(record_date, '%Y-%m-%d') AS month,
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
            -- DATE_FORMAT(record_date, '%Y-%m') AS month,
            DATE_FORMAT(record_date, '%Y-%m-%d') AS month,
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

    public function batCreatorSummary()
    {
        $result = cache()->remember('bat_creator_summary', 3600, function () {
            $data = DB::select("SELECT
                channel,
                count(id) AS summary
            FROM
                creators
            WHERE
                active = 1
            GROUP BY
                channel
            ORDER BY 
                summary desc");
            $labels = collect($data)->map(fn ($item) => $item->channel);
            $summaries = collect($data)->map(fn ($item) => $item->summary);
            return [
                'labels' => $labels,
                'data' => $summaries
            ];
        });
        return $result;
    }

    public function creatorStats($channel = null)
    {
        // work on channel later
        $data = DB::select("SELECT
            DATE_FORMAT(record_date, '%Y-%m') AS month,
            max(verified_creators) AS verified_creators
        FROM (
            SELECT
                record_date,
                sum(verified_creators) AS verified_creators
            FROM
                creator_stats
            GROUP BY
                record_date) t
        GROUP BY
            month
        ORDER BY
            month");
        $labels = collect($data)->map(fn ($item) => $item->month);
        $verified_creators = collect($data)->map(fn ($item) => $item->verified_creators);

        return [
            'labels' => $labels,
            'data' => [
                'Verified Creators' => $verified_creators
            ]
        ];
    }
}
