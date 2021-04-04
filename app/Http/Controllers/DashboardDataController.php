<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardDataController extends Controller
{
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
}
