<?php

namespace Tests\Unit\Models\Stats;

use App\Models\Stats\BatStats;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BatStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function bat_stats_can_update_holder_add()
    {
        $today_stat = BatStats::factory()->create([
            'record_date' => Carbon::today(),
            'holders_count' => 15000,
        ]);
        $yesterday_stat = BatStats::factory()->create([
            'record_date' => Carbon::yesterday(),
            'holders_count' => 10000,
        ]);
        $today_stat->calculateIncrements();
        $this->assertEquals(5000, $today_stat->fresh()->holders_add);
        $yesterday_stat->calculateIncrements();
        $this->assertNull($yesterday_stat->fresh()->holders_add);
    }

    /**
     * @test
     * @group api
     */
    public function bat_stats_get_data()
    {
        BatStats::generate();

        $bat_stat = BatStats::first();
        $this->assertGreaterThan(300000, $bat_stat->holders_count);
        $this->assertEquals(Carbon::today(), $bat_stat->record_date);
    }
}
