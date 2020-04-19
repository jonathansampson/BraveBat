<?php

namespace Tests\Unit\Services;

use App\Services\TwitchService;
use Tests\TestCase;

class TwitchServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function twitch_service_can_get_a_twitch_user_info_with_a_valid_username()
    {
        $service = new TwitchService;
        $response = $service->getUser('allorzer0');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['display_name'], "AllOrZer0");
    }

    /**
     * @test
     * @group api
     */
    public function twitch_service_cannot_get_a_twitch_user_info_with_an_invalid_username()
    {
        $service = new TwitchService;
        $response = $service->getUser('dsfadsfsadsdfssffasdfasfs');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'User not found');
    }
}
