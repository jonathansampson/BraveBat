<?php

namespace Tests\Unit\Models\CreatorProcessors;

use Tests\TestCase;
use App\Models\Creator;
use App\Models\CreatorProcessors\YoutubeProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorYoutubeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_youtube_can_pull_data_with_good_youtube_id()
    {
        $creator = Creator::create([
            'channel_id' => 'UCrp_UI8XtuYfpiqluWLD7Lw',
            'creator' => 'youtube#channel:UCrp_UI8XtuYfpiqluWLD7Lw',
            'channel' => 'youtube',
        ]);
        $processor = new YoutubeProcessor($creator);
        $processor->process();
        $this->assertEquals('CNBC Television', $creator->name);
        $this->assertNotNull($creator->description);
        $this->assertNotNull($creator->thumbnail);
        $this->assertGreaterThan(50, $creator->follower_count);
        $this->assertGreaterThan(10000000, $creator->view_count);
        $this->assertGreaterThan(30000, $creator->video_count);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://www.youtube.com/channel/UCrp_UI8XtuYfpiqluWLD7Lw', $creator->link);
    }

    /**
     * @test
     * @group api
     */
    public function creator_youtube_cannot_pull_data_with_invalid_youtube_id()
    {
        $creator = Creator::create([
            'channel_id' => 'dfdsfs',
            'creator' => 'youtube#channel:dfdsfs',
            'channel' => 'youtube',
        ]);
        $processor = new YoutubeProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }

    /**
     * @test
     * @group api
     */
    public function creator_youtube_can_pull_data_with_long_description()
    {
        $creator = Creator::create([
            'channel_id' => 'UCrIocXxiqVRWjFB9snysqHw',
            'creator' => 'youtube#channel:UCrIocXxiqVRWjFB9snysqHw',
            'channel' => 'youtube',
        ]);
        $processor = new YoutubeProcessor($creator);
        $processor->process();
        $this->assertEquals('A JAH', $creator->name);
        $this->assertTrue($creator->valid);
    }
}
