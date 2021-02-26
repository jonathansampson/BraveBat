<?php

namespace App\Services;

use Protobuf\UnknownFieldSet;

class BraveProtoApiService
{
    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public function import()
    {
        // $data = file_get_contents("https://rewards.brave.com/publishers/prefix-list");
        // $proto = new PublisherPrefixList();

        $data = file_get_contents("https://pcdn.brave.com/publishers/prefixes/12e3");
        $a = new UnknownFieldSet();
        dd($a->unserialize($data));
        dd(12);
    }
}
