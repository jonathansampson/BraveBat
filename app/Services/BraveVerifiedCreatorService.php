<?php

namespace App\Services;

use App\Models\Creator;
use Log;

class BraveVerifiedCreatorService
{
    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public static function import()
    {
        $url = "https://publishers-distro.basicattentiontoken.org/api/v1/public/channels";
        $content = json_decode(file_get_contents($url));
        $apiInfo = collect($content)->map(function ($item) {
            return trim($item[0]);
        })->unique()->toArray();
        Log::notice('complete api array');
        $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();
        Log::notice('complete database array');
        $incomings = array_diff($apiInfo, $databaseInfo);
        Log::notice('complete incoming array');
        $outgoings = array_diff($databaseInfo, $apiInfo);
        Log::notice('complete outgoing array');
        Creator::handleInput($incomings, $outgoings);
    }
}
