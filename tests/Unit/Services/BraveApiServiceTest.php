<?php

namespace Tests\Unit\Services;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Creator;
use App\Models\ImportLog;
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
        factory(Creator::class)->create(['creator' => 'heliat.fr']);
        factory(Creator::class)->create(['creator' => 'outgoing.com']);

        BraveApiService::import();
        $import_log = ImportLog::first();
        $this->assertDatabaseHas('import_logs', [
            'yesterday_count' => 2,
            'today_count' => 7,
            'incomings' => 6,
            'outgoings' => 1
        ]);
        $this->assertCount(7, Creator::all());
        $this->assertDatabaseHas('creators', [
            'creator' => 'linuxiarze.pl',
            'channel' => 'website',
            'verified_at' => Carbon::today()->toDateString()
        ]);
        $this->assertDatabaseMissing('creators', [
            'creator' => 'outgoing.com',
        ]);
    }
}
