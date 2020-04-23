<?php

namespace Tests\Unit\Models\CreatorProcessors;

use Tests\TestCase;
use App\Models\Creator;
use App\Models\CreatorProcessors\TwitterProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorTwitterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_twitter_can_pull_data_with_good_twitter_id()
    {
        $creator = Creator::create([
            'channel_id' => '23150992',
            'creator' => 'twitter#channel:23150992',
            'channel' => 'twitter',
        ]);
        $processor = new TwitterProcessor($creator);
        $processor->process();
        $this->assertEquals('Songhua', $creator->name);
        $this->assertEquals('Songhua Hu', $creator->display_name);
        $this->assertNotNull($creator->description);
        $this->assertNotNull($creator->thumbnail);
        $this->assertGreaterThan(50, $creator->follower_count);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://twitter.com/Songhua', $creator->link);
    }

    /**
     * @test
     * @group api
     */
    public function creator_twitter_cannot_pull_data_with_invalid_twitter_id()
    {
        $creator = Creator::create([
            'channel_id' => '7897898989898',
            'creator' => 'twitter#channel:7897898989898',
            'channel' => 'twitter',
        ]);
        $processor = new TwitterProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }
}
