<?php

namespace App\Tasks;

use App\RawImport;
use Carbon\Carbon;
use Storage;

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
        $date = Carbon::today()->format('Y-m-d');
        $filename = "brave/{$date}.txt";
        Storage::put($filename, $file);

        $content = json_decode($file);

        RawImport::truncate();
        foreach ($content as $creator) {
            RawImport::create([
                'creator' => $creator[0],
                'detail' => json_encode($creator)
            ]);
        }
    }
}
