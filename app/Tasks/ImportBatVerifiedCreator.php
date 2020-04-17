<?php

namespace App\Tasks;

use Storage;
use Carbon\Carbon;
use App\Models\RawImport;

class ImportBatVerifiedCreator
{
    /**
     * Import Brave Verified Creator from unofficial API endpoint to database in raw format
     *
     * @return void
     */
    public static function import()
    {
        $url = "https://publishers-distro.basicattentiontoken.org/api/v1/public/channels";
        $file = file_get_contents($url);
        $content = json_decode($file);
        foreach ($content as $input) {
            RawImport::handleInput($input);
        }
    }
}
        // $date = Carbon::today()->format('Y-m-d');
        // $filename = "brave/{$date}.txt";
        // $exists = Storage::exists($filename);
        // if (!$exists) {
        //     Storage::put($filename, $file);
        // }
