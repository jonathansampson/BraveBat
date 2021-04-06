<?php

namespace App\Models\Ads;

use App\Models\Ads\AdsCreative;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsSet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adsCreatives()
    {
        return $this->hasMany(AdsCreative::class, 'ads_set_id');
    }

    public function adsOses()
    {
        return $this->belongsToMany(AdsOs::class, 'ads_set_os', 'ads_set_id', 'ads_os_id');
    }

    public function adsSegments()
    {
        return $this->belongsToMany(AdsSegment::class, 'ads_set_segment', 'ads_set_id', 'ads_segment_id');
    }
}
