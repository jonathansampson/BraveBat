<?php

namespace App\Services;

use Log;
use Storage;
use Carbon\Carbon;
use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BraveVerifiedCreatorService
{
    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public static function import()
    {
        $date = Carbon::today()->format('Y-m-d');

        $url = config('bravebat.brave_api');
        $file = file_get_contents($url);
        $filename = "brave/{$date}.txt";
        Storage::put($filename, $file);
        $content = json_decode($file);

        $apiInfo = array_unique(array_filter(array_map(function ($item) {
            if ($item[1] == '') return null;
            return trim($item[0]);
        }, $content)));
        $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();
        SimpleScheduledTaskSlackAndLogService::message('The count of new api is  ' . count($apiInfo));
        SimpleScheduledTaskSlackAndLogService::message('The count of database is  ' . count($databaseInfo));
        $incomings = array_diff($apiInfo, $databaseInfo);
        $outgoings = array_diff($databaseInfo, $apiInfo);
        SimpleScheduledTaskSlackAndLogService::message('The count of incomings is  ' . count($incomings));
        SimpleScheduledTaskSlackAndLogService::message('The count of outgoings is  ' . count($outgoings));
        Creator::handleInput($incomings, $outgoings);
    }
}
