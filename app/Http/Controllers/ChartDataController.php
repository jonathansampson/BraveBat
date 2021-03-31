<?php

namespace App\Http\Controllers;

use App\Repositories\ChartDataRepository;
use Illuminate\Http\Request;

class ChartDataController extends Controller
{
// return cache()->remember('dau', 86400, function () {
//     return $this->chartDataRepository->dau();
// });

    private $chartDataRepository;

    public function __construct(ChartDataRepository $chartDataRepository)
    {
        $this->chartDataRepository = $chartDataRepository;
    }

    public function dau()
    {
        return $this->chartDataRepository->dau();
    }

    public function mau()
    {
        return $this->chartDataRepository->mau();
    }

    public function bat_purchases()
    {
        return $this->chartDataRepository->bat_purchases();
    }

    public function bat_purchases_in_dollars()
    {
        return $this->chartDataRepository->bat_purchase_in_dollars();
    }

    public function ad_campaign_supported_countries()
    {
        return $this->chartDataRepository->ad_campaign_supported_countries();
    }

    public function active_ad_campaigns(Request $request)
    {
        return $this->chartDataRepository->active_ad_campaigns($request->country);
    }

    public function bat_creator_summary()
    {
        return $this->chartDataRepository->bat_creator_summary();
    }

    public function creator_stats()
    {
        return $this->chartDataRepository->creator_stats();
    }

    public function creator_daily_total_stats($channel = null)
    {
        return $this->chartDataRepository->creator_daily_total_stats($channel);
    }

    public function creator_daily_addition_stats($channel = null)
    {
        return $this->chartDataRepository->creator_daily_addition_stats($channel);
    }

    public function top_creators($channel)
    {
        return $this->chartDataRepository->top_creators($channel);
    }

    public function creator_validation($channel)
    {
        return $this->chartDataRepository->creator_validation($channel);

    }

    public function communities($site, $community)
    {
        return $this->chartDataRepository->communities($site, $community);
    }
}
