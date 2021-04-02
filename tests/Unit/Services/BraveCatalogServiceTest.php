<?php

namespace Tests\Unit\Services;

use App\Services\BraveCatalogService;
use Tests\TestCase;

class BraveCatalogServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_can_get_issuers()
    {
        $service = new BraveCatalogService();
        $issuers = $service->getIssuers();
        $this->assertGreaterThan(5, count($issuers));
        $issuer1 = $issuers[0];
        $this->assertArrayHasKey('name', $issuer1);
        $this->assertArrayHasKey('publicKey', $issuer1);
    }

    /**
     * @test
     * @group api
     */
    public function it_can_get_campaigns()
    {
        $service = new BraveCatalogService();
        $campaigns = $service->getCampaigns();
        $this->assertGreaterThan(20, count($campaigns));
        $campaign1 = $campaigns[0];
        $this->assertArrayHasKey('endAt', $campaign1);
        $this->assertArrayHasKey('startAt', $campaign1);
        $this->assertArrayHasKey('dailyCap', $campaign1);
        $this->assertArrayHasKey('dayParts', $campaign1);
        $this->assertArrayHasKey('priority', $campaign1);
        $this->assertArrayHasKey('campaignId', $campaign1);
        $this->assertArrayHasKey('geoTargets', $campaign1);
        $this->assertArrayHasKey('advertiserId', $campaign1);
        $this->assertArrayHasKey('creativeSets', $campaign1);
    }

    /**
     * @test
     * @group api
     */
    public function it_can_get_day_parts()
    {
        $service = new BraveCatalogService();
        $dayParts = $service->getDayParts();
        $this->assertGreaterThan(20, count($dayParts));
    }

    /**
     * @test
     * @group api
     */
    public function it_can_get_geo_targets()
    {
        $service = new BraveCatalogService();
        $geoTargets = $service->getGeoTargets();
        $this->assertGreaterThan(20, count($geoTargets));
    }
}
