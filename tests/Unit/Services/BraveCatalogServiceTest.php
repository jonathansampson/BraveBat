<?php

namespace Tests\Unit\Services;

use App\Models\Ads\AdsCampaign;
use App\Models\Ads\AdsCreative;
use App\Models\Ads\AdsGeo;
use App\Models\Ads\AdsOs;
use App\Models\Ads\AdsSegment;
use App\Models\Ads\AdsSet;
use App\Services\BraveCatalogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BraveCatalogServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group api
     */
    public function it_can_get_campaigns()
    {
        $service = new BraveCatalogService();
        $campaigns = $service->getCampaignsData();
        $this->assertGreaterThan(6, count($campaigns));
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
    public function it_can_process_a_campaign()
    {
        $service = new BraveCatalogService();
        $campaigns = $service->getCampaignsData();
        $campaign = $campaigns[0];
        $service->processCampaignData($campaign);
        $this->assertGreaterThanOrEqual(1, AdsCampaign::count());
        $this->assertGreaterThanOrEqual(1, AdsGeo::count());
        $this->assertGreaterThanOrEqual(1, AdsSet::count());
        $this->assertGreaterThanOrEqual(1, AdsOs::count());
        $this->assertGreaterThanOrEqual(1, AdsSegment::count());
        $this->assertGreaterThanOrEqual(1, AdsCreative::count());

    }

}
