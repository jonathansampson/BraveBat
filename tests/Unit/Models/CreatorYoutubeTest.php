<?php

namespace Tests\Unit\Models;

use App\Models\Creators\Youtube;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorYoutubeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_youtube_can_pull_data_with_good_youtube_id()
    {
        $youtube = Youtube::create(['youtube_id' => 'UCrp_UI8XtuYfpiqluWLD7Lw']);
        $creator = $youtube->creator()->create(['creator' => 'Something']);
        $youtube->callApi();
        $this->assertEquals($youtube->fresh()->name, "CNBC Television");
        $this->assertEquals($creator->fresh()->name, "CNBC Television");
    }

    /**
     * @test
     * @group api
     */
    public function creator_youtube_cannot_pull_data_with_invalid_youtube_id()
    {
        $youtube = Youtube::create(['youtube_id' => 'dfdsfs']);
        $creator = $youtube->creator()->create(['creator' => 'Something']);
        $youtube->callApi();
        $this->assertNull($youtube->fresh()->name);
        $this->assertNull($creator->fresh()->name);
    }
}
