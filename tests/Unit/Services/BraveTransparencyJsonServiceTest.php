<?php

namespace Tests\Unit\Services;

use App\Services\BraveTransparencyJsonService;
use Tests\TestCase;

class BraveTransparencyJsonServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_can_get_campaigns_data()
    {
        $service = new BraveTransparencyJsonService();
        $results = $service->getAdCampaigns();
        $this->assertArrayHasKey('country', $results[0]);
        $this->assertArrayHasKey('campaigns', $results[0]);
        $this->assertArrayHasKey('record_date', $results[0]);
    }

    /**
     * @test
     * @group api
     */
    public function it_can_get_bat_data()
    {
        $service = new BraveTransparencyJsonService();

        $results = $service->getBatPurchases();
        $this->assertArrayHasKey('transaction_date', $results[0]);
        $this->assertArrayHasKey('transaction_amount', $results[0]);
        $this->assertArrayHasKey('transaction_record', $results[0]);
        $this->assertArrayHasKey('transaction_site', $results[0]);
    }
}
