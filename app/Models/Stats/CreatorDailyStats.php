<?php

namespace App\Models\Stats;

use App\Services\SimpleScheduledTaskSlackAndLogService;
use App\Services\TweetService;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

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
                    'channel' => $result->channel,
                ],
                [
                    'addition' => $result->addition,
                    'total' => $result->total,
                ]
            );
        }
    }

    public static function total($date, $channel = null)
    {
        if ($channel) {
            return CreatorDailyStats::where('record_date', $date)->where('channel', $channel)->sum('total');
        } else {
            return CreatorDailyStats::where('record_date', $date)->sum('total');
        }
    }

    public static function addition($date)
    {
        return CreatorDailyStats::where('record_date', $date)->sum('addition');
    }

    public static function channelTweet()
    {
        $channels = [
            'website' => 10000,
            'youtube' => 50000,
            'reddit' => 10000,
            'github' => 10000,
            'vimeo' => 10000,
            'twitter' => 10000,
            'twitch' => 10000,
        ];
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        foreach ($channels as $channel => $threshold) {
            $todayTotal = floor(self::total($today, $channel) / $threshold);
            $yesterdayTotal = floor(self::total($yesterday, $channel) / $threshold);
            if ($todayTotal > $yesterdayTotal) {
                $milestone = $todayTotal * $threshold;
                $message = "The number of verified {$channel} Brave Creators has just surpassed {$milestone}! Be #brave. https://bravebat.info";
                SimpleScheduledTaskSlackAndLogService::message($message);
                $tweet_service = new TweetService();
                $tweet_service->postTweet($message);
            }
        }
    }

    public static function overallTweet()
    {
        $threshold = 100000;
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $todayTotal = floor(self::total($today) / $threshold);
        $yesterdayTotal = floor(self::total($yesterday) / $threshold);
        if ($todayTotal > $yesterdayTotal) {
            $milestone = $todayTotal * $threshold;
            $message = "The number of verified Brave Creators has just surpassed {$milestone}. #bravebrowser \$BAT https://bravebat.info";
            SimpleScheduledTaskSlackAndLogService::message($message);
            $tweet_service = new TweetService();
            $tweet_service->postTweet($message);
        }
    }
}
