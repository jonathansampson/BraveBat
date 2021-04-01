<?php

namespace App\Services;

use Publishers_pb\ChannelResponseList;
use Publishers_pb\PublisherPrefixList;

class BraveProtoApiService
{
    public function getChannels(string $prefix)
    {
        $fp = fopen("https://pcdn.brave.com/publishers/prefixes/" . $prefix, 'rb');
        $header = fread($fp, 4);
        $length = hexdec(bin2hex($header));
        $body = fread($fp, $length);
        $response = brotli_uncompress($body);
        $channelResponseList = new ChannelResponseList();
        $channelResponseList->mergeFromString($response);
        $channels = $channelResponseList->getChannelResponses();
        return collect($channels)->map(fn($channel) => $channel->getChannelIdentifier())->toArray();
    }

    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public function getPrefixes()
    {
        $data = file_get_contents("https://rewards.brave.com/publishers/prefix-list");
        $prefixList = new PublisherPrefixList();
        $prefixList->mergeFromString($data);
        $byteArray = unpack("C*", brotli_uncompress($prefixList->getPrefixes()));

        $prefixes = [];
        $counter = 0;
        while ($counter < 100) {
            $counter++;
            $part1 = dechex(array_shift($byteArray));
            $part2 = dechex(array_shift($byteArray));
            $part3 = dechex(array_shift($byteArray));
            $part4 = dechex(array_shift($byteArray));
            $prefix = substr($part1 . $part2 . $part3 . $part4, -10);
            $prefixes[] = $prefix;
        }
        dd($prefixes);

    }

}
