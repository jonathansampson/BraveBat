<?php

namespace App\Repositories;

use App\Models\BraveUsage;
use DB;

class ChartDataRepository
{
    public function dau()
    {
        $title = 'Brave Browser DAU (M)';
        $data = BraveUsage::all();
        $labels = collect($data)->map(fn($item) => $item['month']);
        $dau = collect($data)->map(fn($item) => round(($item['dau'] / 1000000), 1));
        return [
            'labels' => $labels,
            'data' => [
                $title => $dau,
            ],
        ];
    }

    public function mau()
    {
        $title = 'Brave Browser MAU (M)';
        $data = array_filter(BraveUsage::all(), function ($item) {
            return isset($item['mau']);
        });
        $labels = collect($data)->map(fn($item) => $item['month']);
        $mau = collect($data)->map(fn($item) => round(($item['mau'] / 1000000), 1));
        return [
            'labels' => $labels,
            'data' => [
                $title => $mau,
            ],
        ];
    }

    public function bat_purchases()
    {
        $title = 'Brave-Initiated BAT Purchase';
        $data = DB::select("SELECT
                DATE_FORMAT(transaction_date, '%Y-%m') AS month,
                sum(transaction_amount) AS bat_tokens
            FROM
                bat_purchases
            GROUP BY
                month
            ORDER BY
                month DESC");
        $labels = collect($data)->map(fn($item) => $item->month);
        $bat_tokens = collect($data)->map(fn($item) => $item->bat_tokens);
        return [
            'labels' => $labels,
            'data' => [
                $title => $bat_tokens,
            ],
        ];
    }

    public function bat_purchase_in_dollars()
    {
        $title = "Brave-Initiated BAT Purchase ($)";
        $data = DB::select("SELECT
                DATE_FORMAT(transaction_date, '%Y-%m') AS month,
                round(sum(dollar_amount)) AS dollar_amount
            FROM
                bat_purchases
            GROUP BY
                month
            ORDER BY
                month DESC");
        $labels = collect($data)->map(fn($item) => $item->month);
        $dollar_amount = collect($data)->map(fn($item) => $item->dollar_amount);

        return [
            'labels' => $labels,
            'data' => [
                $title => $dollar_amount,
            ],
        ];
    }

    public function ad_campaign_supported_countries()
    {
        $title = 'Brave Verified Creators';
        $data = DB::select("SELECT
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
                month DESC");
        $labels = collect($data)->map(fn($item) => $item->month);
        $countries = collect($data)->map(fn($item) => $item->countries);

        return [
            'labels' => $labels,
            'data' => [
                $title => $countries,
            ],
        ];
    }

    public function active_ad_campaigns($country)
    {
        $country_sql = $country ? "WHERE country = '{$country}'" : "";
        $title = $country ? 'Brave Active Ads Campaigns in ' . $country : 'Brave Active Ads Campaigns';
        $data = DB::select("SELECT
                DATE_FORMAT(record_date, '%Y-%m-%d') AS day,
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
                day
            ORDER BY
                day DESC");
        $labels = collect($data)->map(fn($item) => $item->day);
        $campaigns = collect($data)->map(fn($item) => $item->campaigns);
        return [
            'labels' => $labels,
            'data' => [
                $title => $campaigns,
            ],
        ];
    }

    public function creator_stats()
    {
        $title = 'Brave Verified Creators';
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
                month DESC");
        $labels = collect($data)->map(fn($item) => $item->month);
        $verified_creators = collect($data)->map(fn($item) => $item->verified_creators);

        return [
            'labels' => $labels,
            'data' => [
                $title => $verified_creators,
            ],
        ];
    }

    public function creator_daily_total_stats($channel)
    {
        $title = $channel ? "Verified {$channel} Creators" : "Verified Brave Creators";
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
                    record_date DESC", [$channel]);
        } else {
            $data = DB::select("SELECT
                    record_date,
                    sum(total) AS total
                FROM
                    creator_daily_stats
                GROUP BY
                    record_date
                ORDER BY
                    record_date DESC");
        }
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $total = collect($data)->map(fn($item) => $item->total);
        return [
            'labels' => $labels,
            'data' => [
                $title => $total,
            ],
        ];
    }

    public function creator_daily_addition_stats($channel)
    {
        $title = $channel ? "Daily Verified {$channel} Creators" : "Daily Verfied Brave Creators";
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
                    record_date DESC", [$channel]);
        } else {
            $data = DB::select("SELECT
                    record_date,
                    sum(addition) AS addition
                FROM
                    creator_daily_stats
               WHERE
                    record_date >= '2020-04-25'
                GROUP BY
                    record_date
                ORDER BY
                    record_date DESC");
        }
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $addition = collect($data)->map(fn($item) => $item->addition);
        return [
            'labels' => $labels,
            'data' => [
                $title => $addition,
            ],
        ];
    }

    public function top_creators($channel)
    {
        $title = $channel ? "Top {$channel} Creators" : "Top Creators";
        $data = DB::select("SELECT record_date,
                top_count
                FROM creator_daily_stats
                WHERE top_count IS NOT NULL
                AND channel = ?
                ORDER BY record_date DESC", [$channel]);
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $top_count = collect($data)->map(fn($item) => $item->top_count);
        return [
            'labels' => $labels,
            'data' => [
                $title => $top_count,
            ],
        ];
    }

    public function creator_validation($channel)
    {
        $title = $channel ? "Invalid {$channel} Creators (%)" : "Invalid Creators (%)";
        $data = DB::select("SELECT record_date,
            invalid_percent
            FROM creator_daily_stats
            WHERE invalid_percent IS NOT NULL
            AND channel = ?
            ORDER BY record_date DESC", [$channel]);
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $invalid_percent = collect($data)->map(fn($item) => $item->invalid_percent);
        return [
            'labels' => $labels,
            'data' => [
                $title => $invalid_percent,
            ],
        ];
    }

    public function communities($site, $community)
    {
        $lookups = [
            'youtube' => "YouTube Channel ",
            'reddit' => "Subreddit ",
            'telegram' => "Telegram Group ",
            'twitter' => "Twitter @",
        ];
        $siteFullname = $lookups[$site];
        $title = "$siteFullname{$community} followers";
        $data = DB::select("SELECT record_date,
                subscribers
                FROM communities
                WHERE site = ? AND community = ?
                ORDER BY record_date DESC", [$site, $community]);
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $subscribers = collect($data)->map(fn($item) => $item->subscribers);
        return [
            'labels' => $labels,
            'data' => [
                $title => $subscribers,
            ],
        ];
    }
}
