<?php

namespace App\Services;

use App\Models\Creator;

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
        $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();
        $incomings = array_diff($apiInfo, $databaseInfo);
        $outgoings = array_diff($databaseInfo, $apiInfo);
        dd('here');
        Creator::handleInput($incomings, $outgoings);
    }
}
