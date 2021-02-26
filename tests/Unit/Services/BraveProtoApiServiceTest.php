<?php

namespace Tests\Unit\Services;

use Publishers_pb\ChannelResponse;
use Tests\TestCase;

class BraveProtoApiServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_a_channel_response_based_on_a_prefix()
    {
        // Reach out to CDN for a channel response based on prefix of 12e3
        $data = file_get_contents("https://pcdn.brave.com/publishers/prefixes/12e3");

        // Initiate a class object of ChannelResponse. This is successful.
        $channelResponse = new ChannelResponse();

        // Attempt to load data into the ChannelResponse object. This is successful.
        $channelResponse->mergeFromString($data);

        // Try to get the channel identifier as a test. This is the step when it return null. I suspect that the data file has been compressed
        echo $channelResponse->getChannelIdentifier();
    }
}
