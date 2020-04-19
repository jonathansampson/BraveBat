<?php

namespace Tests\Unit\Models;

use App\Models\Creators\Twitch;
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
        $twitch = Twitch::create(['name' => 'allorzer0']);
        $creator = $twitch->creator()->create(['creator' => 'Something']);
        $twitch->callApi();
        $this->assertEquals($twitch->fresh()->name, "allorzer0");
        $this->assertEquals($creator->fresh()->name, "allorzer0");
    }

    /**
     * @test
     * @group api
     */
    public function creator_twitch_cannot_pull_data_with_invalid_twitch_id()
    {
        $twitch = Twitch::create(['name' => 'allodsfsdfsdfsfssfsfsrzer0']);
        $creator = $twitch->creator()->create(['creator' => 'Something']);
        $twitch->callApi();
        $this->assertNull($twitch->fresh()->twitch_id);
        $this->assertNull($creator->fresh()->name);
    }
}
