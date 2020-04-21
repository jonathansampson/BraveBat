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
        $url = config('bravebat.brave_api');
        $content = json_decode(file_get_contents($url));
        $apiInfo = collect($content)->map(function ($item) {
            return trim($item[0]);
        })->unique()->toArray();
        $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();

        Log::notice('The count of new api is  ' . count($apiInfo));
        Log::notice('The count of database is  ' . count($databaseInfo));
        $incomings = array_diff($apiInfo, $databaseInfo);
        $outgoings = array_diff($databaseInfo, $apiInfo);
        Log::notice('The count of incomings is  ' . count($incomings));
        Log::notice('The count of outgoings is  ' . count($outgoings));
        Creator::handleInput($incomings, $outgoings);
    }
}
