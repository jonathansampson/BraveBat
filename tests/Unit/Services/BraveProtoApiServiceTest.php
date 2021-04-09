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
    public function it_gets_a_channel_response_based_on_a_prefix()
    {
        $service = new BraveProtoApiService();
        $channels = $service->getChannels("12e3");
        $this->assertTrue(in_array('zeetreby.com', $channels));
    }

    /**
     * @test
     * @group api
     */
    public function it_gets_all_prefixes()
    {
        $service = new BraveProtoApiService();
        $prefixes = $service->getPrefixes(10);
        $this->assertEquals(10, count($prefixes));
    }
}
