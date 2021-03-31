<?php

namespace Tests\Unit\Services;

use App\Services\BraveProtoApiService;
use Tests\TestCase;

class BraveProtoApiServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_a_channel_response_based_on_a_prefix()
    {
        $service = new BraveProtoApiService();
        $channels = $service->getChannels("12e3");
        $this->assertEquals('website', $channels[0]['type']);
        $this->assertEquals('zeetreby.com', $channels[0]['id']);

    }

    /**
     * @test
     * @group api
     */
    public function experiment()
    {
        $service = new BraveProtoApiService();
        $channels = $service->getChannels("22cd");
        $this->assertEquals('website', $channels[0]['type']);
        $this->assertEquals('zeetreby.com', $channels[0]['id']);
    }

    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_prefix_list()
    {
        $service = new BraveProtoApiService();
        $service->getPrefixes();

    }
}
