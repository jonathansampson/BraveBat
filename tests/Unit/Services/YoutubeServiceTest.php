<?php

namespace Tests\Unit\Services;

use App\Services\YoutubeService;
use Tests\TestCase;

class YoutubeServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function youtube_service_can_get_data_from_a_valid_id()
    {
        $service = new YoutubeService;
        $response = $service->getChannel('UCrp_UI8XtuYfpiqluWLD7Lw');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['name'], "CNBC Television");
    }

    /**
     * @test
     * @group api
     */
    public function youtube_service_cannot_get_data_from_an_invalid_id()
    {
        $service = new YoutubeService;
        $response = $service->getChannel('fedsfsafds');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], "User not found");
    }
}
