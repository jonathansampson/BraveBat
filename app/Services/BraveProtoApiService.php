<?php

namespace App\Services;

use Publishers_pb\ChannelResponseList;

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
}
