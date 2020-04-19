<?php

namespace Tests\Unit\Models;

use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function creator_can_fill_website_channel()
    {
        $creator = factory(Creator::class)->create(['creator' => 'bravebat.info']);
        $creator->fillChannel();
        $this->assertEquals($creator->fresh()->channel, 'website');
        $this->assertEquals($creator->fresh()->channel_id, 'bravebat.info');
    }

    /**
     * @test
     */
    public function creator_can_fill_non_twitch_channel()
    {
        $creator = factory(Creator::class)->create(['creator' => 'youtube#channel:info']);
        $creator->fillChannel();
        $this->assertEquals($creator->fresh()->channel, 'youtube');
        $this->assertEquals($creator->fresh()->channel_id, 'info');
    }

    /**
     * @test
     */
    public function creator_can_fill_twitch_channel()
    {
        $creator = factory(Creator::class)->create(['creator' => 'twitch#author:helloworld']);
        $creator->fillChannel();
        $this->assertEquals($creator->fresh()->channel, 'twitch');
        $this->assertEquals($creator->fresh()->channel_id, 'helloworld');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_website()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'bravebat.info',
            'channel' => 'website',
            'channel_id' => 'bravebat.info'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'bravebat.info');
        $this->assertEquals($creator->creatable->name, 'bravebat.info');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_youtube()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'youtube#channel:UCrp_UI8XtuYfpiqluWLD7Lw',
            'channel' => 'youtube',
            'channel_id' => 'UCrp_UI8XtuYfpiqluWLD7Lw'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'CNBC Television');
        $this->assertEquals($creator->creatable->name, 'CNBC Television');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_twitch()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'twitch#author:allorzer0',
            'channel' => 'twitch',
            'channel_id' => 'allorzer0'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'allorzer0');
        $this->assertEquals($creator->creatable->name, 'allorzer0');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_twitter()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'twitter#channel:23150992',
            'channel' => 'twitter',
            'channel_id' => '23150992'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'Songhua');
        $this->assertEquals($creator->creatable->name, 'Songhua');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_vimeo()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'vimeo#channel:46924634',
            'channel' => 'vimeo',
            'channel_id' => '46924634'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'rashiptrikha');
        $this->assertEquals($creator->creatable->name, 'rashiptrikha');
    }
}
