<?php

namespace App\Http\Controllers;

use DB;
use App\Models\BraveUsage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ChartDataController extends Controller
{
    public function dau()
    {
        $result = cache()->remember('dau', 86400, function () {
            $data = BraveUsage::all();
            $labels = collect($data)->map(fn ($item) => $item['month']);
            $dau = collect($data)->map(fn ($item) => round(($item['dau'] / 1000000), 1));
            return [
                'labels' => $labels,
                'data' => [
                    'Daily Active Users' => $dau
                ]
            ];
        });
        return $result;
    }

    public function batPurchases()
    {
        $result = cache()->remember('bat_purchase', 86400, function () {
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
        });
        return $result;
    }

    public function adCampaignSupportedCountries()
    {
        $result = cache()->remember('ad_campaign_supported_countries', 86400, function () {
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
        });
        return $result;
    }

    public function activeAdCampaigns(Request $request)
    {
        $country = $request->country;
        $country_string  = ($country) ? '_' . Str::snake($country) : '';
        $result = cache()->remember('active_ad_campaigns' . $country_string, 86400, function () use ($country) {
            $country_sql = $country ? "WHERE country = '{$country}'" : "";
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
                {$country_sql}
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
        });
        return $result;
    }

    public function batCreatorSummary()
    {
        $result = cache()->remember('bat_creator_summary', 3600, function () {
            $data = DB::select("SELECT
                channel,
                count(id) AS summary
            FROM
                creators
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

    public function creatorStats()
    {
        $result = cache()->remember('creator_stats', 86400, function () {
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
        });
        return $result;
    }


    public function creatorDailyTotalStats($channel = null)
    {
        $result = cache()->remember('creator_daily_total_stats_' . $channel, 86400, function () use ($channel) {
            if ($channel) {
                $data = DB::select("SELECT
                    record_date,
                    sum(total) AS total
                FROM
                    creator_daily_stats
                WHERE 
                    channel = ?
                GROUP BY
                    record_date
                ORDER BY 
                    record_date", [$channel]);
            } else {
                $data = DB::select("SELECT
                    record_date,
                    sum(total) AS total
                FROM
                    creator_daily_stats
                GROUP BY
                    record_date
                ORDER BY 
                    record_date");
            }
            $labels = collect($data)->map(fn ($item) => $item->record_date);
            $total = collect($data)->map(fn ($item) => $item->total);
            return [
                'labels' => $labels,
                'data' => ['Total Verified Creators' => $total]
            ];
        });
        return $result;
    }

    public function creatorDailyAdditionStats($channel = null)
    {
        $result = cache()->remember('creator_daily_addition_stats_' . $channel, 86400, function () use ($channel) {
            if ($channel) {
                $data = DB::select("SELECT
                    record_date,
                    sum(addition) AS addition
                FROM
                    creator_daily_stats
                WHERE 
                    channel = ? AND record_date >= '2020-05-01'
                GROUP BY
                    record_date
                ORDER BY 
                    record_date", [$channel]);
            } else {
                $data = DB::select("SELECT
                    record_date,
                    sum(addition) AS addition
                WHERE 
                    record_date >= '2020-04-25'
                FROM
                    creator_daily_stats
                GROUP BY
                    record_date
                ORDER BY 
                    record_date");
            }
            $labels = collect($data)->map(fn ($item) => $item->record_date);
            $addition = collect($data)->map(fn ($item) => $item->addition);
            return [
                'labels' => $labels,
                'data' => ['Daily New Verified Creators' => $addition]
            ];
        });
        return $result;
    }
}
