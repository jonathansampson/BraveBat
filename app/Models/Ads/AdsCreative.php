<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsCreative extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function url()
    {
        $url = $this->notification_target_url ?? $this->page_destination_url;
        return parse_url($url)['host'];
    }
}
