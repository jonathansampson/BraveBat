<?php

namespace App\Tasks;

use App\RawImport;
use Carbon\Carbon;
use Storage;

class ImportBatVerifiedCreator
{
    public static function import()
    {
        // $url = "https://publishers-distro.basicattentiontoken.org/api/v1/public/channels";
        // $file = file_get_contents($url);
        $date = Carbon::today()->format('Y-m-d');
        $filename = "{$date}.txt";
        // Storage::put($filename, $file);
        $file = Storage::get($filename);
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
