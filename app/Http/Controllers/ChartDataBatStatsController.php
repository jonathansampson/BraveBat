<?php

namespace App\Http\Controllers;

use App\Models\Stats\BatStats;

class ChartDataBatStatsController extends Controller
{
    public function batPrice()
    {
        $stats = BatStats::getData();
        $labels = $stats->map(fn ($item) => $item->record_date);
        $data = $stats->map(fn ($item) => $item->price);
        return [
            'labels' => $labels,
            'data' => ['Price' => $data]
        ];
    }

    public function batHoldersCount()
    {
        $stats = BatStats::getData();
        $labels = $stats->map(fn ($item) => $item->record_date);
        $data = $stats->map(fn ($item) => $item->holders_count);
        return [
            'labels' => $labels,
            'data' => ['BAT Addresses (Thousands)' => $data]
        ];
    }

    public function batHoldersAdd()
    {
        $stats = BatStats::getData();
        $labels = $stats->map(fn ($item) => $item->record_date);
        $data = $stats->map(fn ($item) => $item->holders_add);
        return [
            'labels' => $labels,
            'data' => ['BAT Addresses Daily Addition' => $data]
        ];
    }

    public function batMarketCap()
    {
        $stats = BatStats::getData();
        $labels = $stats->map(fn ($item) => $item->record_date);
        $data = $stats->map(fn ($item) => round($item->market_cap / 1000000, 2));
        return [
            'labels' => $labels,
            'data' => ['Market Cap ($Millions)' => $data]
        ];
    }

    public function batVolume()
    {
        $stats = BatStats::getData();
        $labels = $stats->map(fn ($item) => $item->record_date);
        $data = $stats->map(fn ($item) => round($item->volume / 1000000, 2));
        return [
            'labels' => $labels,
            'data' => ['Daily Trading Volume (Millions)' => $data]
        ];
    }
}
