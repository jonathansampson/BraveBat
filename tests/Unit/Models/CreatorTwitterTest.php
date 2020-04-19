<?php

namespace Tests\Unit\Models;

use App\Models\Creators\Twitter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorTwitterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_twitter_can_pull_data_with_good_twitter_id()
    {
        $twitter = Twitter::create(['twitter_id' => '23150992']);
        $creator = $twitter->creator()->create(['creator' => 'Something']);
        $twitter->callApi();
        $this->assertEquals($twitter->fresh()->name, "Songhua");
        $this->assertEquals($creator->fresh()->name, "Songhua");
    }

    /**
     * @test
     * @group api
     */
    public function creator_twitter_cannot_pull_data_with_invalid_twitter_id()
    {
        $twitter = Twitter::create(['twitter_id' => '7897898989898']);
        $creator = $twitter->creator()->create(['creator' => 'Something']);
        $twitter->callApi();
        $this->assertNull($twitter->fresh()->name);
        $this->assertNull($twitter->fresh()->name);
    }
}
