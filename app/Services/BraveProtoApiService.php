<?php

namespace App\Services;

use Publishers_pb\ChannelResponseList;
use Publishers_pb\PublisherPrefixList;

class BraveProtoApiService
{
    public function getChannels(string $prefix)
    {
        $fp = fopen(config('bravebat.brave_prefix_channel_url') . $prefix, 'rb');
        $header = fread($fp, 4);
        $length = hexdec(bin2hex($header));
        $body = fread($fp, $length);
        $response = brotli_uncompress($body);
        $channelResponseList = new ChannelResponseList();
        $channelResponseList->mergeFromString($response);
        $channels = $channelResponseList->getChannelResponses();
        return collect($channels)->map(fn($channel) => $channel->getChannelIdentifier())->toArray();
    }

    public function getPrefixes($take = null)
    {
        $data = file_get_contents(config("bravebat.brave_prefix_list_url"));
        $prefixList = new PublisherPrefixList();
        $prefixList->mergeFromString($data);
        $byteArray = unpack("C*", brotli_uncompress($prefixList->getPrefixes()));
        $prefixes = [];
        $count = 0;
        while (true) {
            $count++;
            if ($take && $count > $take) {
                break;
            }
            $part1 = dechex(array_shift($byteArray));
            $part2 = dechex(array_shift($byteArray));
            $part3 = dechex(array_shift($byteArray));
            $part4 = dechex(array_shift($byteArray));
            $prefix = $part1 . $part2 . $part3 . $part4;
            if ($prefix) {
                $prefixes[] = $prefix;
            } else {
                break;
            }
        }
        return $prefixes;
    }
}
