<?php

namespace Tests\Feature\Tasks;

use App\Models\Stats\CreatorDailyStats;
use App\Tasks\GenerateCreateDailyStatsFromBatWatch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateCreateDailyStatsFromBatWatchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function it_can_get_data()
    {
        (new GenerateCreateDailyStatsFromBatWatch())->generate();
        $this->assertCount(7, CreatorDailyStats::all());
    }

    /**
     * @test
     */
    public function it_can_get_backfill()
    {
        factory(CreatorDailyStats::class)->create([
            'channel' => 'youtube',
            'total' => '10',
            'addition' => '0',
            'record_date' => '2020-10-24',
        ]);
        factory(CreatorDailyStats::class)->create([
            'channel' => 'youtube',
            'total' => '10000',
            'addition' => '0',
            'record_date' => '2020-10-27',
        ]);
        (new GenerateCreateDailyStatsFromBatWatch())->backfill('youtube', '2020-10-24', '2020-10-27');
        $this->assertCount(4, CreatorDailyStats::all());
        $day25 = CreatorDailyStats::where('channel', 'youtube')->where('record_date', '2020-10-25')->first();
        $day26 = CreatorDailyStats::where('channel', 'youtube')->where('record_date', '2020-10-26')->first();
        $day27 = CreatorDailyStats::where('channel', 'youtube')->where('record_date', '2020-10-27')->first();
        $this->assertEquals(10000, $day27->total);
        $this->assertEquals(9990, $day25->addition + $day26->addition + $day27->addition);
    }
}
