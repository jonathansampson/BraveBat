<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Services\BraveTransparencyService;
use App\Services\BraveTransparencyJsonService;

class BatPurchase extends Model
{
    protected $guarded = [];

    public static function import()
    {
        // $service = new BraveTransparencyService;
        $service = new BraveTransparencyJsonService;
        $bat_purchases = $service->getBatPurchases();
        foreach ($bat_purchases as $bat_purchase) {
            self::updateOrCreate(
                ['transaction_record' => $bat_purchase['transaction_record']],
                [
                    'transaction_date' => $bat_purchase['transaction_date'],
                    'transaction_amount' => $bat_purchase['transaction_amount']
                ]
            );
        }
    }
}
