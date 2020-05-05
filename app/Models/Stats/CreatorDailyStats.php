<?php

namespace App\Models\Stats;

use Illuminate\Database\Eloquent\Model;
use DB;

class CreatorDailyStats extends Model
{
    protected $table = 'creator_daily_stats';
    protected $guarded = [];

    public static function generate($date_string)
    {
        $results = DB::select("SELECT
            channel,
            count(case when verified_at = ? then 1 end) AS addition,
            count(case when verified_at <= ? then 1 end) AS total
        FROM
            creators
        GROUP BY
            channel", [$date_string, $date_string]);
        foreach ($results as $result) {
            self::updateOrCreate(
                [
                    'record_date' => $date_string,
                    'channel' => $result->channel
                ],
                [
                    'addition' => $result->addition,
                    'total' => $result->total,
                ]
            );
        }
    }
}
