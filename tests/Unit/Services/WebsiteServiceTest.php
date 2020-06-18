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

    /**
     * @test
     * @group api
     */
    public function website_service_cannot_get_alexa_ranking_of_an_valid_website_if_ranking_is_too_low()
    {
        $service = new WebsiteService;
        $response = $service->getAlexaRank('twips.app');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'Invalid website or alexa ranking too low');
    }

    /**
     * @test
     * @group api
     */
    public function website_service_can_take_screenshot_of_valid_website()
    {
        $service = new WebsiteService;
        $response = $service->getScreenshot('https://google.com');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['screenshot'], 'website_screenshots/google_com.png');
    }

    /**
     * @test
     * @group api
     */
    public function website_service_cannot_take_screenshot_of_valid_http_website_with_https_connection()
    {
        $service = new WebsiteService;
        $response = $service->getScreenshot('https://neverssl.com');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'Invalid website');
    }

    /**
     * @test
     * @group api
     */
    public function website_service_cannot_take_screenshot_of_invalid_website()
    {
        $service = new WebsiteService;
        $response = $service->getScreenshot('https://sdkfjaskjfkasjfkas.com');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], 'Invalid website');
    }
}
