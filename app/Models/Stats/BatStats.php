<?php

namespace App\Models\Stats;

use App\Services\EthplorerService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BatStats extends Model
{
    use HasFactory;

    protected $table = 'bat_stats';
    protected $guarded = [];
    protected $casts = [
        'record_date' => 'date',
    ];

    public static function generate()
    {
        $today = Carbon::today();
        $service = new EthplorerService();
        $data = $service->getStats();
        if ($data['success']) {
            $bat_stat = self::updateOrCreate(
                ['record_date' => $today],
                $data['result']
            );
            $bat_stat->calculateIncrements();
        }
    }

    public function calculateIncrements()
    {
        $yesterday = $this->record_date->subDay(1);
        $yesterday_stat = BatStats::where('record_date', $yesterday)->first();
        if ($yesterday_stat) {
            $this->holders_add = $this->holders_count - $yesterday_stat->holders_count;
            $this->save();
        }
    }

    public static function getData()
    {
        $result = cache()->remember('bat_stats', 86400, function () {
            $data = DB::select("SELECT record_date, holders_count, holders_add, price, volume, market_cap FROM bat_stats ORDER BY record_date DESC");
            return collect($data);
        });
        return $result;
    }
}
