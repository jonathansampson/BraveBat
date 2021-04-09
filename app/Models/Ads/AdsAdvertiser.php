<?php

namespace App\Models\Ads;

use App\Models\Ads\AdsCampaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsAdvertiser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adsCampaigns()
    {
        return $this->hasMany(AdsCampaign::class, 'ads_advertiser_id');
    }
}
