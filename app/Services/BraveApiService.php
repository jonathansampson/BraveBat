<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BraveApiService
{
    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public static function import()
    {
        $file = file_get_contents(config('bravebat.brave_api'));
        // $date = Carbon::today()->format('Y-m-d');
        // $filename = "brave/{$date}.txt";
        // Storage::put($filename, $file);
        $content = json_decode($file);
        dd($content);
        $apiInfo = array_unique(array_filter(array_map(function ($item) {
            if ($item[1] == '') return null;
            return trim($item[0]);
        }, $content)));
        $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();

        $incomings = array_diff($apiInfo, $databaseInfo);
        $outgoings = array_diff($databaseInfo, $apiInfo);
        Creator::handleIncomings($incomings);
        Creator::handleOutgoings($outgoings);
    }
}
