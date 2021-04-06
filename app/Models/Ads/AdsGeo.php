<?php

namespace App\Models\Ads;

use App\Models\Ads\AdsCampaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsGeo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adsCampaigns()
    {
        return $this->belongsToMany(AdsCampaign::class, 'ads_campaign_geo', 'ads_geo_id', 'ads_campaign_id');
    }
}
