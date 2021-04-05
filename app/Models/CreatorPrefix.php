<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Publishers_pb\PublisherPrefixList;

class CreatorPrefix extends Model
{
    protected $table = "prefixes";
    use HasFactory;

    protected $guarded = [];

    public static function generate()
    {
        $data = file_get_contents("https://rewards.brave.com/publishers/prefix-list");
        $prefixList = new PublisherPrefixList();
        $prefixList->mergeFromString($data);
        $byteArray = unpack("C*", brotli_uncompress($prefixList->getPrefixes()));

        while (true) {
            $part1 = dechex(array_shift($byteArray));
            $part2 = dechex(array_shift($byteArray));
            $part3 = dechex(array_shift($byteArray));
            $part4 = dechex(array_shift($byteArray));
            $prefix = $part1 . $part2 . $part3 . $part4;
            if ($prefix) {
                $existing = self::where('prefix', $prefix)->first();
                if ($existing) {
                    $existing->touch();
                } else {
                    self::create(['prefix' => $prefix]);
                }
            } else {
                break;
            }
        }
    }
}

// /**
//  * @test
//  * @group api
//  */
// public function it_tries_to_get_prefix_list()
// {
//     $service = new BraveProtoApiService();
//     $service->getPrefixes();
//     $this->assertEquals(1, 1);
// }
