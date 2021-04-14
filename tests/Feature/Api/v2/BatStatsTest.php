<?php

namespace Tests\Feature\Api\v2;

use App\Models\Stats\BatStats;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BatStatsTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/bat_stats/all';
        BatStats::factory()->create([
            "holders_count" => 1000,
            "holders_add" => 100,
            "price" => 1.243,
            "volume" => 1_000_000,
            "market_cap" => 1_000_0000_000,
            "record_date" => "2021-04-14",
        ]);
        BatStats::factory()->create([
            "holders_count" => 2000,
            "holders_add" => 200,
            "price" => 2.243,
            "volume" => 2_000_000,
            "market_cap" => 2_000_0000_000,
            "record_date" => "2021-04-15",
        ]);

    }

    /** @test */
    public function it_can()
    {
        $response = $this->postJson($this->endpoint);
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) =>
                $json->has(2)
                    ->first(fn($json) =>
                        $json->where('holders_count', 2000)
                            ->etc()
                    )
            );

    }
}
