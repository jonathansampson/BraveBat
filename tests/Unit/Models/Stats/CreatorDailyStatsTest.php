<?php

namespace Tests\Unit\Models\Stats;

use App\Models\Stats\CreatorDailyStats;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorDailyStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function daily_stats_can_generate_addition()
    {
        $first = CreatorDailyStats::factory()->create([
            'record_date' => '2019-01-01',
            'total' => 12,
            'addition' => 0,
            'channel' => 'youtube',
        ]);
        $second = CreatorDailyStats::factory()->create([
            'record_date' => '2019-01-03',
            'total' => 25,
            'addition' => 0,
            'channel' => 'youtube',
        ]);
        $first->generateAddition();
        $second->generateAddition();
        $this->assertEquals(0, $first->fresh()->addition);
        $this->assertEquals(13, $second->fresh()->addition);
    }
}
