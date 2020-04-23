<?php

namespace Tests\Unit\Models\CreatorProcessors;

use Tests\TestCase;
use App\Models\Creator;
use App\Models\CreatorProcessors\VimeoProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorVimeoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_vimeo_can_pull_data_with_good_vimeo_id()
    {
        $creator = Creator::create([
            'channel_id' => '46924634',
            'creator' => 'vimeo#channel:46924634',
            'channel' => 'vimeo',
        ]);
        $processor = new VimeoProcessor($creator);
        $processor->process();
        $this->assertEquals('Raship Trikha', $creator->name);
        $this->assertEquals('Raship Trikha', $creator->display_name);
        $this->assertNotNull($creator->description);
        $this->assertNotNull($creator->thumbnail);
        $this->assertGreaterThan(50, $creator->follower_count);
        $this->assertGreaterThan(20, $creator->video_count);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://vimeo.com/rashiptrikha', $creator->link);
    }

    /**
     * @test
     * @group api
     */
    public function creator_vimeo_cannot_pull_data_with_invalid_vimeo_id()
    {
        $creator = Creator::create([
            'channel_id' => '3278989898989898',
            'creator' => 'vimeo#channel:3278989898989898',
            'channel' => 'vimeo',
        ]);
        $processor = new VimeoProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }
}
