<?php

namespace Tests\Unit\Services;

use Publishers_pb\ChannelResponseList;
use Publishers_pb\PublisherPrefixList;
use Tests\TestCase;

class BraveProtoApiServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_a_channel_response_based_on_a_prefix()
    {
        // Stream the file from https://pcdn.brave.com/publishers/prefixes/0804
        $fp = fopen("https://pcdn.brave.com/publishers/prefixes/12e3", 'rb');

        // Get the first 4 bytes, convert from binary to hex and then from hex to demical
        $header = fread($fp, 4);
        $length = hexdec(bin2hex($header)); // $length = 852

        // Read the rest of the file and use Brotli to uncompress it
        $body = fread($fp, $length);
        $response = brotli_uncompress($body);
        // Initiate a class object of ChannelResponseList and inject the API data into the object
        $channelResponseList = new ChannelResponseList();
        $channelResponseList->mergeFromString($response);

        // Loop through the list array and properly get the result. SUCCESS!
        // foreach ($channelResponseList->getChannelResponses() as $channelResponse) {
        //     echo ($channelResponse->getChannelIdentifier());
        //     echo "\n";
        // }
    }

    /**
     * @test
     * @group api
     */
    public function it_tries_to_get_prefix_list()
    {

        $data = file_get_contents("https://rewards.brave.com/publishers/prefix-list");
        $prefix = new PublisherPrefixList();
        $prefix->mergeFromString($data);
        $response = brotli_uncompress($prefix->getPrefixes());

        $byteArray = unpack("C*", $response);

        dd(count($byteArray));
        dd(array_shift($byteArray), array_shift($byteArray), array_shift($byteArray), array_shift($byteArray), array_shift($byteArray), array_shift($byteArray), array_shift($byteArray), array_shift($byteArray));
        // Stream the file from https://rewards.brave.com/publishers/prefix-list
        $fp = fopen("https://rewards.brave.com/publishers/prefix-list", 'rb');

        // Get the first 4 bytes, convert from binary to hex and then from hex to demical
        $header = fread($fp, 4);
        $length = hexdec(bin2hex($header)); // $length = 134_483_969 (this does not seem to make sense because it is much bigger than the file byte size)

        ini_set('memory_limit', '-1');
        $body = fread($fp, $length);
        $response = brotli_uncompress($body); // FAIL here. Message: Brotli decompress failed
    }
}
