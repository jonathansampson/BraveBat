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
        $this->assertEquals($creator->fresh()->name, 'Raship Trikha');
    }

    /**
     * @test
     * @group api
     */
    public function creator_can_process_github()
    {
        $creator = factory(Creator::class)->create([
            'creator' => 'github#channel:4323180',
            'channel' => 'github',
            'channel_id' => '4323180'
        ]);
        $creator->processCreatable();
        $this->assertEquals($creator->fresh()->name, 'adamwathan');
    }

    /**
     * @test
     */
    public function creator_can_rank_website()
    {
        $creator1 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'website',
            'alexa_ranking' => 10,
            'valid' => true
        ]);
        $creator2 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'website',
            'alexa_ranking' => 100,
            'valid' => true
        ]);
        $creator3 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'website',
            'alexa_ranking' => 1000,
            'valid' => true
        ]);
        $creator4 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'website',
            'alexa_ranking' => 10000,
            'valid' => true
        ]);
        Creator::fillRankings();
        $this->assertEquals(1, $creator1->fresh()->ranking);
        $this->assertEquals(0.1, $creator2->fresh()->ranking);
        $this->assertEquals(0.01, $creator3->fresh()->ranking);
        $this->assertEquals(0.001, $creator4->fresh()->ranking);
    }

    /**
     * @test
     */
    public function creator_can_rank_youtube()
    {
        $creator1 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'youtube',
            'follower_count' => 10,
            'valid' => true
        ]);
        $creator2 = factory(Creator::class)->create([
            'name' => '123',

            'channel' => 'youtube',
            'follower_count' => 100,
            'valid' => true
        ]);
        $creator3 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'youtube',
            'follower_count' => 1000,
            'valid' => true
        ]);
        $creator4 = factory(Creator::class)->create([
            'name' => '123',
            'channel' => 'youtube',
            'follower_count' => 10000,
            'valid' => true
        ]);
        Creator::fillRankings();
        $this->assertEquals(0.001, $creator1->fresh()->ranking);
        $this->assertEquals(0.01, $creator2->fresh()->ranking);
        $this->assertEquals(0.1, $creator3->fresh()->ranking);
        $this->assertEquals(1, $creator4->fresh()->ranking);
    }

    /**
     * @test
     */
    public function creator_can_rank_brased_on_ceiling()
    {
        $creator = factory(Creator::class)->create([
            'channel' => 'youtube',
            'follower_count' => 100000,
            'valid' => true
        ]);
        $creator->getRanking(1000000);
        $this->assertEquals(0.1, $creator->fresh()->ranking);

        $creator = factory(Creator::class)->create([
            'channel' => 'youtube',
            'follower_count' => 0,
            'valid' => true
        ]);
        $creator->getRanking(1000000);
        $this->assertEquals(0, $creator->fresh()->ranking);

        $creator = factory(Creator::class)->create([
            'channel' => 'website',
            'alexa_ranking' => 10,
            'valid' => true
        ]);
        $creator->getRanking(10);
        $this->assertEquals(1, $creator->fresh()->ranking);

        $creator = factory(Creator::class)->create([
            'channel' => 'website',
            'alexa_ranking' => 10000,
            'valid' => true
        ]);
        $creator->getRanking(10);
        $this->assertEquals(0.001, $creator->fresh()->ranking);
    }
}
