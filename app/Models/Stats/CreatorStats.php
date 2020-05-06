<?php

namespace App\Models\Stats;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CreatorStats extends Model
{
    protected $table = 'creator_stats';
    protected $guarded = [];
    protected $casts = [
        'record_date' => 'date',
    ];

    public static function generate()
    {
        $date = Carbon::now()->startOfMonth()->toDateString();
        $total = CreatorDailyStats::total($date);
        self::updateOrCreate(
            ['record_date' => $date],
            ['verified_creators' => $total, 'channel' => 'all'],
        );
    }
}
