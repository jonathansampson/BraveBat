<?php

namespace Tests\Unit\Models;

use App\Models\Community;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function community_can_create_reddit_community()
    {
        Community::createRedditCommunity('brave_browser');
        $community = Community::first();
        $this->assertEquals('reddit', $community->site);
        $this->assertEquals('brave_browser', $community->community);
    }

    /**
     * @test
     * @group api
     */
    public function community_can_create_twitter_community()
    {
        Community::createTwitterCommunity('brave', '257245904');
        $community = Community::first();
        $this->assertEquals('twitter', $community->site);
        $this->assertEquals('brave', $community->community);
    }

    /**
     * @test
     * @group api
     */
    public function community_can_create_youtube_community()
    {
        Community::createYoutubeCommunity('bravesoftware', 'UCFNTTISby1c_H-rm5Ww5rZg');
        $community = Community::first();
        $this->assertEquals('youtube', $community->site);
        $this->assertEquals('bravesoftware', $community->community);
    }

    /**
     * @test
     * @group api
     */
    public function community_can_create_telegram_community()
    {
        Community::createTelegramCommunity('batproject');
        $community = Community::first();
        $this->assertEquals('telegram', $community->site);
        $this->assertEquals('batproject', $community->community);
    }
}
