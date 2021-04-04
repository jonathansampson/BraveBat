<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardDataController extends Controller
{

    public function index($endpoint)
    {
        return cache()->remember('dashboard.' . $endpoint, 86400, function () use ($endpoint) {
            return $this->{$endpoint}();
        });
    }

    public function daily_verified()
    {
        $title = 'Daily Verified Creators';
        $data = DB::select("SELECT
                verified_at as record_date,
                count(id) AS count
            FROM
                creators
                WHERE verified_at > CURRENT_DATE - INTERVAL 90 DAY
            GROUP BY
                verified_at
            ORDER BY
                verified_at DESC");
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $counts = collect($data)->map(fn($item) => $item->count);
        return [
            'labels' => $labels,
            'data' => [
                $title => $counts,
            ],
        ];
    }

    public function daily_confirmed()
    {
        $title = 'Daily Confirmed Creators';
        $data = DB::select("SELECT
                confirmed_at as record_date,
                count(id) AS count
            FROM
                creators
                WHERE confirmed_at > CURRENT_DATE - INTERVAL 90 DAY
            GROUP BY
                confirmed_at
            ORDER BY
                confirmed_at DESC");
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $counts = collect($data)->map(fn($item) => $item->count);
        return [
            'labels' => $labels,
            'data' => [
                $title => $counts,
            ],
        ];
    }

    public function daily_processed()
    {
        $title = 'Daily Processed Creators';
        $data = DB::select("SELECT
                last_processed_at as record_date,
                count(id) AS count
            FROM
                creators
                WHERE last_processed_at > CURRENT_DATE - INTERVAL 90 DAY
            GROUP BY
                last_processed_at
            ORDER BY
                last_processed_at DESC");
        $labels = collect($data)->map(fn($item) => $item->record_date);
        $counts = collect($data)->map(fn($item) => $item->count);
        return [
            'labels' => $labels,
            'data' => [
                $title => $counts,
            ],
        ];
    }
}
