<?php

namespace App\Tasks;

use App\Models\Creator;
use App\Models\Stats\CreatorDailyStats;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateCreatorDailyStats
{
    public static function invalidPercent()
    {
        $results = DB::select("SELECT
                channel,
                verified_at,
                sum(CASE WHEN valid = 1 THEN 0 ELSE 1 END) / count(id) * 100 AS invalid_percent
            FROM
                creators
            WHERE
                verified_at >= '2020-05-01'
                AND channel in('youtube', 'vimeo', 'twitch', 'github', 'twitter')
            GROUP BY
                channel,
                verified_at");
        foreach ($results as $result) {
            CreatorDailyStats::updateOrCreate(
                [
                    'record_date' => $result->verified_at,
                    'channel' => $result->channel,
                ],
                [
                    'invalid_percent' => $result->invalid_percent,
                ]
            );
        }
    }

    public static function topCreators()
    {
        self::topWebsite();
        self::topYoutube();
        self::topGithub();
        self::topTwitch();
        self::topTwitter();
        self::topVimeo();
    }

    public static function topWebsite()
    {
        $channel = 'website';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('alexa_ranking', '<=', config('bravebat.top_creators_cutoff.website'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }

    public static function topYoutube()
    {
        $channel = 'youtube';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('follower_count', '>=', config('bravebat.top_creators_cutoff.youtube'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }

    public static function topTwitter()
    {
        $channel = 'twitter';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('follower_count', '>=', config('bravebat.top_creators_cutoff.twitter'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }

    public static function topTwitch()
    {
        $channel = 'twitch';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('follower_count', '>=', config('bravebat.top_creators_cutoff.twitch'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }

    public static function topVimeo()
    {
        $channel = 'vimeo';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('follower_count', '>=', config('bravebat.top_creators_cutoff.vimeo'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }

    public static function topGithub()
    {
        $channel = 'github';
        $count = Creator::where('valid', true)
            ->where('channel', $channel)
            ->where('follower_count', '>=', config('bravebat.top_creators_cutoff.github'))
            ->count();
        CreatorDailyStats::updateOrCreate(
            [
                'record_date' => Carbon::today()->toDateString(),
                'channel' => $channel,
            ],
            [
                'top_count' => $count,
            ]
        );
    }
}
