<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsOs extends Model
{
    protected $table = "ads_oses";
    protected $guarded = [];

    use HasFactory;

    public function adsSets()
    {
        return $this->belongsToMany(AdsSet::class, 'ads_set_os', 'ads_os_id', 'ads_set_id');
    }
}
