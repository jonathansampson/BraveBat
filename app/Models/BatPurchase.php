<?php

namespace App\Models;

use App\Services\TweetService;
// use App\Services\BraveTransparencyService;
use Illuminate\Database\Eloquent\Model;
use App\Services\BraveTransparencyJsonService;
use App\Services\UpholdService;

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
                $new_purchase = self::create([
                    'transaction_record' => $bat_purchase['transaction_record'],
                    'transaction_date' => $bat_purchase['transaction_date'],
                    'transaction_amount' => $bat_purchase['transaction_amount']
                ]);
                $tweet_service = new TweetService();
                $message = 'Brave has purchased ' . number_format($bat_purchase['transaction_amount']) . ' BATs for its ad campaigns. 🎉 ' . route('stats.brave_initiated_bat_purchase');
                $tweet_service->postTweet($message);
                $new_purchase->fetchDollarAmount();
            }
        }
    }

    public function link()
    {
        return "https://uphold.com/reserve/transactions/" . $this->transaction_record;
    }

    public function fetchDollarAmount()
    {
        $service = new UpholdService();
        $dollarAmount = $service->getDollarAmount($this->link());
        $this->dollar_amount = $dollarAmount;
        $this->save();
    }

    public static function backfillDollarAmount()
    {
        self::whereNull('dollar_amount')->get()->each(function ($purchase) {
            $purchase->fetchDollarAmount();
            sleep(30);
        });
    }
}
