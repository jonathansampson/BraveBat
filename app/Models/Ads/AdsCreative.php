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

    public function copyTitle()
    {
        return $this->notification_title ?? $this->page_company_name;
    }

    public function copyBody()
    {
        return $this->notification_body ?? $this->page_logo_alt;
    }

    public function type()
    {
        if ($this->name === "notification") {
            return 'Notification Ad';
        }
        if ($this->name === "new_page_tab") {
            return 'Tab Ad';
        }
    }
}
