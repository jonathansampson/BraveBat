<?php

namespace App\Models\Ads;

use App\Models\Ads\AdsCampaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdsAdvertiser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adsCampaigns()
    {
        return $this->hasMany(AdsCampaign::class, 'ads_advertiser_id');
    }

    public function website()
    {
        if (Str::startsWith($this->website, ['https://', 'http://'])) {
            return $this->website;
        }
        return 'https://' . $this->website;
    }

}
