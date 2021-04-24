<?php

namespace App\Models;

use App\Jobs\ProcessBatPurchase;
use App\Models\Stats\BatStats;
use App\Services\BraveTransparencyJsonService;
use App\Services\UpholdService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatPurchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function import()
    {
        $service = app(BraveTransparencyJsonService::class);
        $bat_purchases = $service->getBatPurchases();
        foreach ($bat_purchases as $bat_purchase) {
            $existing = self::where('transaction_record', $bat_purchase['transaction_record'])->first();
            if (!$existing) {
                $newPurchase = self::create([
                    'transaction_record' => $bat_purchase['transaction_record'],
                    'transaction_date' => $bat_purchase['transaction_date'],
                    'transaction_amount' => $bat_purchase['transaction_amount'],
                    'transaction_site' => $bat_purchase['transaction_site'],
                ]);
                ProcessBatPurchase::dispatch($newPurchase);
            }
        }
    }

    public function link()
    {
        return "https://uphold.com/reserve/transactions/" . $this->transaction_record;
    }

    public function fetchDollarAmountFromUphold()
    {
        $service = app(UpholdService::class);
        $dollarAmount = $service->getDollarAmount($this->link());
        $this->dollar_amount = $dollarAmount;
        $this->save();
    }

    public function fetchDollarAmountOutsideUphold()
    {
        $batStat = BatStats::where('record_date', "<=", $this->transaction_date)->orderBy('record_date', "desc")->first();
        $this->dollar_amount = $batStat->price * $this->transaction_amount;
        $this->save();
    }

    public function fetchDollarAmount()
    {
        if ($this->transaction_site == "Uphold") {
            $this->fetchDollarAmountFromUphold();
        } else {
            $this->fetchDollarAmountOutsideUphold();
        }
    }

    public function tweetMessage()
    {
        return "Brave has purchased " . number_format($this->transaction_amount) . " BATs for its ad campaigns on " . $this->transaction_site . " 🎉 " . route('stats.brave_initiated_bat_purchase');
    }

    public static function backfillDollarAmount()
    {
        self::whereNull('dollar_amount')->get()->each(function ($purchase) {
            $purchase->fetchDollarAmount();
            sleep(30);
        });
    }
}
