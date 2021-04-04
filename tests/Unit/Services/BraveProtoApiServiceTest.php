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
        $this->assertTrue(in_array('zeetreby.com', $channels));
    }

    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_prefix_list()
    {
        $service = new BraveProtoApiService();
        $service->getPrefixes();
        $this->assertEquals(1, 1);
    }
}
