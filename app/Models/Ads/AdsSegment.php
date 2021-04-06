<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsSegment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adsSets()
    {
        return $this->belongsToMany(AdsSet::class, 'ads_set_segment', 'ads_segment_id', 'ads_set_id');
    }
}
