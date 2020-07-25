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

    public function batPurchasesDollars()
    {
        $result = cache()->remember('bat_purchase_dollar', 86400, function () {
            $data = DB::select("SELECT 
                DATE_FORMAT(transaction_date, '%Y-%m') AS month,
                sum(dollar_amount) AS dollar_amount
            FROM
                bat_purchases
            GROUP BY
                month
            ORDER BY
                month");
            $labels = collect($data)->map(fn ($item) => $item->month);
            $dollar_amount = collect($data)->map(fn ($item) => $item->dollar_amount);

            return [
                'labels' => $labels,
                'data' => [
                    'BAT Purchased In Dollars' => $dollar_amount
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
                    channel = ? AND record_date >= '2020-05-02'
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

    public function topCreators($channel)
    {
        $result = cache()->remember('top_creators_' . $channel, 86400, function () use ($channel) {
            $data = DB::select("SELECT record_date, 
                top_count 
                FROM creator_daily_stats 
                WHERE top_count IS NOT NULL 
                AND channel = ? 
                ORDER BY record_date", [$channel]);
            $labels = collect($data)->map(fn ($item) => $item->record_date);
            $top_count = collect($data)->map(fn ($item) => $item->top_count);
            return [
                'labels' => $labels,
                'data' => ['Top Creators' => $top_count]
            ];
        });
        return $result;
    }

    public function creatorValidation($channel)
    {
        $result = cache()->remember('creator_validation_' . $channel, 86400, function () use ($channel) {
            $data = DB::select("SELECT record_date, 
            invalid_percent 
            FROM creator_daily_stats 
            WHERE invalid_percent IS NOT NULL 
            AND channel = ?
            ORDER BY record_date", [$channel]);
            $labels = collect($data)->map(fn ($item) => $item->record_date);
            $invalid_percent = collect($data)->map(fn ($item) => $item->invalid_percent);
            return [
                'labels' => $labels,
                'data' => ['Invalid Percent (%)' => $invalid_percent]
            ];
        });
        return $result;
    }

    public function communities($site, $community)
    {
        $result = cache()->remember('community_' . $site . '_' . $community, 86400, function () use ($site, $community) {
            $data = DB::select("SELECT record_date, 
                subscribers 
                FROM communities 
                WHERE site = ? AND community = ?
                ORDER BY record_date", [$site, $community]);
            $labels = collect($data)->map(fn ($item) => $item->record_date);
            $subscribers = collect($data)->map(fn ($item) => $item->subscribers);
            return [
                'labels' => $labels,
                'data' => ['Subscribers' => $subscribers]
            ];
        });
        return $result;
    }
}
