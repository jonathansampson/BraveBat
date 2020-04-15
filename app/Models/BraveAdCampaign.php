<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\BraveTransparencyService;

class BraveAdCampaign extends Model
{
    protected $guarded = [];

    public static function import()
    {
        $service = new BraveTransparencyService;
        $bat_ad_campaigns = $service->getAdCampaigns();
        foreach ($bat_ad_campaigns as $bat_ad_campaign) {
            self::updateOrCreate($bat_ad_campaign);
        }
    }
}
