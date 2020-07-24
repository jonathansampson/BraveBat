<?php

namespace App\Models;

use App\Services\TweetService;
// use App\Services\BraveTransparencyService;
use Illuminate\Database\Eloquent\Model;
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
            $existing = self::where('transaction_record', $bat_purchase['transaction_record'])->first();
            if (!$existing) {
                self::create([
                    'transaction_record' => $bat_purchase['transaction_record'],
                    'transaction_date' => $bat_purchase['transaction_date'],
                    'transaction_amount' => $bat_purchase['transaction_amount']
                ]);
                $tweet_service = new TweetService();
                $message = 'Brave has purchased ' . number_format($bat_purchase['transaction_amount']) . ' BATs for its ad campaigns. 🎉 ' . route('stats.brave_initiated_bat_purchase');
                $tweet_service->postTweet($message);
            }
        }
    }
}
