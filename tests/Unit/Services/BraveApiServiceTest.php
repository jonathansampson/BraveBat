<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\BraveApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BraveApiServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function it_can_import_brave_api_creator_data()
    {
        config()->set('bravebat.brave_api', 'https://bravebat.info/test.txt');
        BraveApiService::import();
    }
}


// $file = file_get_contents(config('bravebat.brave_api'));
// // $date = Carbon::today()->format('Y-m-d');
// // $filename = "brave/{$date}.txt";
// // Storage::put($filename, $file);
// $content = json_decode($file);
// $apiInfo = array_unique(array_filter(array_map(function ($item) {
//     if ($item[1] == '') return null;
//     return trim($item[0]);
// }, $content)));
// $databaseInfo = Creator::where('active', true)->pluck('creator')->toArray();

// $incomings = array_diff($apiInfo, $databaseInfo);
// $outgoings = array_diff($databaseInfo, $apiInfo);
// Creator::handleIncomings($incomings);
// Creator::handleOutgoings($outgoings);
