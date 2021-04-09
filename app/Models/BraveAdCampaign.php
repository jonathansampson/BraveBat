<?php

namespace App\Models;

use App\Services\BraveTransparencyJsonService;
// use App\Services\BraveTransparencyService;
use Illuminate\Database\Eloquent\Model;

class BraveAdCampaign extends Model
{
    protected $guarded = [];

    public static function import()
    {
        // $service = new BraveTransparencyService;
        $service = new BraveTransparencyJsonService;
        $bat_ad_campaigns = $service->getAdCampaigns();
        foreach ($bat_ad_campaigns as $bat_ad_campaign) {
            self::updateOrCreate(
                [
                    'record_date' => $bat_ad_campaign['record_date'],
                    'country' => $bat_ad_campaign['country'],
                ],
                [
                    'campaigns' => $bat_ad_campaign['campaigns'],
                ]
            );
        }
    }

}
