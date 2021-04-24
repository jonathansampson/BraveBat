<?php

namespace Tests\Unit\Models;

use App\Jobs\ProcessBatPurchase;
use App\Models\BatPurchase;
use App\Models\Stats\BatStats;
use App\Services\BraveTransparencyJsonService;
use App\Services\UpholdService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class BatPurchaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_import()
    {
        Bus::fake();
        $mock = $this->mock(BraveTransparencyJsonService::class, function ($mock) {
            $mock->shouldReceive('getBatPurchases')->once()->andReturn([
                [
                    "transaction_record" => '1212',
                    "transaction_date" => '2019-01-01',
                    "transaction_amount" => '123',
                    "transaction_site" => "Coinbase",
                ],
            ]);
        });
        BatPurchase::import();
        Bus::assertDispatched(ProcessBatPurchase::class);
        $this->assertCount(1, BatPurchase::all());
    }

    /** @test */
    public function it_can_make_tweet_message()
    {
        $batPurchase = BatPurchase::factory()->create([
            "transaction_amount" => 1000000,
            "transaction_site" => "Coinbase",
        ]);
        $this->assertEquals("Brave has purchased 1,000,000 BATs for its ad campaigns on Coinbase 🎉 http://bravebat.test/brave_initiated_bat_purchase", $batPurchase->tweetMessage());
    }

    /**
     * @test
     * @group api
     **/
    public function it_can_fetch_dollar_amount_from_uphold()
    {
        $this->mock(UpholdService::class, function ($mock) {
            $mock->shouldReceive('getDollarAmount')->once()->andReturn(100000);
        });
        $batPurchase = BatPurchase::factory()->create();
        $this->assertNull($batPurchase->dollar_amount);
        $batPurchase->fetchDollarAmountFromUphold();
        $this->assertEquals(100000, $batPurchase->dollar_amount);
    }

    /**
     * @test
     * @group api
     **/
    public function it_can_fetch_dollar_amount_for_coinbase()
    {
        $batPurchase = BatPurchase::factory()->create([
            'transaction_amount' => 10,
            'transaction_date' => '2019-01-10',
        ]);
        BatStats::factory()->create([
            "price" => 0.10,
            'record_date' => '2019-01-10',
        ]);
        BatStats::factory()->create([
            "price" => 0.09,
            'record_date' => '2019-01-09',
        ]);
        BatStats::factory()->create([
            "price" => 0.11,
            'record_date' => '2019-01-11',
        ]);
        $this->assertNull($batPurchase->dollar_amount);
        $batPurchase->fetchDollarAmountOutsideUphold();
        $this->assertEquals(1, $batPurchase->dollar_amount);
    }
}
