<?php

namespace App\Models;

use Carbon\Carbon;
use App\Services\RedditService;
use App\Services\TelegramService;
use App\Services\TwitterService;
use App\Services\YoutubeService;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $guarded = [];

    public static function generate()
    {
        $communities = config('bravebat.communities');

        foreach ($communities['reddit'] as $community) {
            self::createRedditCommunity($community);
        }

        foreach ($communities['telegram'] as $community) {
            self::createTelegramCommunity($community);
        }

        foreach ($communities['twitter'] as $community => $communityId) {
            self::createTwitterCommunity($community, $communityId);
        }

        foreach ($communities['youtube'] as $community => $communityId) {
            self::createYoutubeCommunity($community, $communityId);
        }
    }

    public static function createRedditCommunity($community)
    {
        $today = Carbon::today()->toDateString();
        $service = new RedditService();
        $result = $service->getSubreddit($community);
        if ($result['success']) {
            self::updateOrCreate(
                [
                    'record_date' => $today,
                    'site' => 'reddit',
                    'community' => $community
                ],
                [
                    'subscribers' => $result['result']['subscribers']
                ]
            );
        }
    }

    public static function createTwitterCommunity($community, $communityId)
    {
        $today = Carbon::today()->toDateString();
        $service = new TwitterService();
        $result = $service->getUser($communityId);
        if ($result['success']) {
            self::updateOrCreate(
                [
                    'record_date' => $today,
                    'site' => 'twitter',
                    'community' => $community
                ],
                [
                    'subscribers' => $result['result']['follower_count']
                ]
            );
        }
    }

    public static function createYoutubeCommunity($community, $communityId)
    {
        $today = Carbon::today()->toDateString();
        $service = new YoutubeService();
        $result = $service->getChannel($communityId);
        if ($result['success']) {
            self::updateOrCreate(
                [
                    'record_date' => $today,
                    'site' => 'youtube',
                    'community' => $community
                ],
                [
                    'subscribers' => $result['result']['follower_count']
                ]
            );
        }
    }

    public static function createTelegramCommunity($community)
    {
        $today = Carbon::today()->toDateString();
        $service = new TelegramService();
        $result = $service->getChatMembersCount($community);
        if ($result['success']) {
            self::updateOrCreate(
                [
                    'record_date' => $today,
                    'site' => 'telegram',
                    'community' => $community
                ],
                [
                    'subscribers' => $result['result']['subscribers']
                ]
            );
        }
    }
}
