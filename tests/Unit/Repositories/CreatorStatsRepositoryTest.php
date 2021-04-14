<?php

namespace Tests\Unit\Repositories;

use App\Models\Stats\CreatorDailyStats;
use App\Repositories\CreatorStatsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorStatsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_creator_by_channels_data()
    {
        CreatorDailyStats::factory()->create([
            'channel' => 'youtube',
            'record_date' => today(),
            'total' => 1000,
        ]);

        CreatorDailyStats::factory()->create([
            'channel' => 'youtube',
            'record_date' => today()->subDay(7),
            'total' => 900,
        ]);

        CreatorDailyStats::factory()->create([
            'channel' => 'youtube',
            'record_date' => today()->subDay(30),
            'total' => 800,
        ]);
        CreatorDailyStats::factory()->create([
            'channel' => 'youtube',
            'record_date' => today()->subDay(90),
            'total' => 500,
        ]);

        CreatorDailyStats::factory()->create([
            'channel' => 'youtube',
            'record_date' => today()->subDay(365),
            'total' => 100,
        ]);

        $results = (new CreatorStatsRepository())->creatorsByChannels();
        $this->assertEquals(1, count($results));
        $result = $results[0];
        $this->assertEquals('youtube', $result->channel);
        $this->assertEquals(1000, $result->total_today);
        $this->assertEquals(900, $result->total_7d_ago);
        $this->assertEquals(800, $result->total_1m_ago);
        $this->assertEquals(500, $result->total_3m_ago);
        $this->assertEquals(100, $result->total_1y_ago);
    }
}
