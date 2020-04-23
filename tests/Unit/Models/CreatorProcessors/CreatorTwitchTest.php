<?php

namespace Tests\Unit\Models\CreatorProcessors;

use App\Models\Creator;
use App\Models\CreatorProcessors\TwitchProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorTwitchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_twitch_can_pull_data_with_good_twitch_id()
    {
        $creator = Creator::create([
            'channel_id' => 'allorzer0',
            'creator' => 'twitch#author:allorzer0',
            'channel' => 'twitch',
        ]);
        $processor = new TwitchProcessor($creator);
        $processor->process();
        $this->assertEquals('allorzer0', $creator->name);
        $this->assertEquals('AllOrZer0', $creator->display_name);
        $this->assertNotNull($creator->description);
        $this->assertNotNull($creator->thumbnail);
        $this->assertGreaterThan(1000, $creator->view_count);
        $this->assertGreaterThan(50, $creator->follower_count);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://www.twitch.tv/allorzer0', $creator->link);
    }

    /**
     * @test
     * @group api
     */
    public function creator_twitch_cannot_pull_data_with_invalid_twitch_id()
    {
        $creator = Creator::create([
            'channel_id' => 'allodsfsdfsdfsfssfsfsrzer0',
            'creator' => 'twitch#author:allodsfsdfsdfsfssfsfsrzer0',
            'channel' => 'twitch',
        ]);
        $processor = new TwitchProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }
}
