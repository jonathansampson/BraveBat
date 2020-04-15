<?php

namespace App\Models;

use App\Services\BraveTransparencyService;
use Illuminate\Database\Eloquent\Model;

class BatPurchase extends Model
{
    protected $guarded = [];

    public static function import()
    {
        $service = new BraveTransparencyService;
        $bat_purchases = $service->getBatPurchases();
        foreach ($bat_purchases as $bat_purchase) {
            self::updateOrCreate($bat_purchase);
        }
    }
}
