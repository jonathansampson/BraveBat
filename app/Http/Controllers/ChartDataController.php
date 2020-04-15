<?php

namespace App\Http\Controllers;

use App\Models\BraveUsage;
use DB;

class ChartDataController extends Controller
{
    public function dau()
    {
        $labels = BraveUsage::pluck('month');
        $dau = collect(BraveUsage::pluck('dau'))->map(fn ($item) => round(($item / 1000000), 1));

        return [
            'labels' => $labels,
            'data' => [
                'Daily Active Users' => $dau
            ]
        ];
    }

    public function batPurchase()
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
}
