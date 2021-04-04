<?php

namespace Tests\Unit\Services;

use App\Services\WebsiteService;
use Tests\TestCase;

class WebsiteServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function website_service_can_get_alexa_rank_of_a_valid_https_website()
    {
        $service = new WebsiteService;
        $response = $service->getAlexaRank('google.com');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['alexa_ranking'], 1);
    }

    /**
     * @test
     * @group api
     */
    public function website_service_can_get_alexa_rank_of_a_valid_http_website()
    {
        $service = new WebsiteService;
        $response = $service->getAlexaRank('neverssl.com');
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('alexa_ranking', $response['result']);
    }

    /**
     * @test
     * @group api
     */
    public function website_service_cannot_get_alexa_ranking_of_an_invalid_website()
    {
        $service = new WebsiteService;
        $response = $service->getAlexaRank('sfsdfs.com');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'Invalid website or alexa ranking too low');
    }

}
