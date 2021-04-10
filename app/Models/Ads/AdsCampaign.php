<?php

namespace App\Models\Ads;

use App\Models\Ads\AdsAdvertiser;
use App\Models\Ads\AdsGeo;
use App\Models\Ads\AdsSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsCampaign extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'start_at', 'end_at',
    ];

    public function adsSets()
    {
        return $this->hasMany(AdsSet::class, 'ads_campaign_id');
    }

    public function adsGeos()
    {
        return $this->belongsToMany(AdsGeo::class, 'ads_campaign_geo', 'ads_campaign_id', 'ads_geo_id');
    }

    public function firstAdsCreative()
    {
        return $this->adsSets()->first()->adsCreatives()->first();
    }

    public function landingUrl()
    {
        return $this->firstAdsCreative()->url();
    }

    public function adsAdvertiser()
    {
        return $this->belongsTo(AdsAdvertiser::class, "ads_advertiser_id");
    }

    public function progress()
    {
        $spent = now()->diffInSeconds($this->start_at, false);
        $total = $this->end_at->diffInSeconds($this->start_at, false);
        return ($spent / $total) * 100;
    }

    public function notStarted()
    {
        return $this->progress() < 0;
    }

    public function finished()
    {
        return $this->progress() > 100;
    }

}
