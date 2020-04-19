<?php

namespace Tests\Unit\Services;

use App\Services\TwitterService;
use Tests\TestCase;

class TwitterServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function twitter_service_can_get_data_from_a_valid_handle()
    {
        $service = new TwitterService;
        $response = $service->getUser('23150992');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['name'], "Songhua");
    }

    /**
     * @test
     * @group api
     */
    public function twitter_service_cannot_get_data_from_an_invalid_handle()
    {
        $service = new TwitterService;
        $response = $service->getUser('8273487238478743827432');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'User not found');
    }
}
