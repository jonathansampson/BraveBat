<?php

namespace Tests\Unit\Models\CreatorProcessors;

use Tests\TestCase;
use App\Models\Creator;
use App\Models\CreatorProcessors\WebsiteProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorWebsiteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_website_can_pull_data_with_https_website()
    {
        $creator = Creator::create([
            'channel_id' => 'wikipedia.org',
            'creator' => 'wikipedia.org',
            'channel' => 'website',
        ]);
        $processor = new WebsiteProcessor($creator);
        $processor->process();
        $this->assertEquals('wikipedia.org', $creator->name);
        $this->assertLessThan(100, $creator->alexa_ranking);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://wikipedia.org', $creator->link);
        $this->assertEquals('website_screenshots/wikipedia_org.png', $creator->screenshot);
    }

    /**
     * @test
     * @group api
     */
    public function creator_website_can_pull_data_with_http_website()
    {
        $creator = Creator::create([
            'channel_id' => 'neverssl.com',
            'creator' => 'neverssl.com',
            'channel' => 'website',
        ]);
        $processor = new WebsiteProcessor($creator);
        $processor->process();
        $this->assertEquals('neverssl.com', $creator->name);
        $this->assertLessThan(1000000, $creator->alexa_ranking);
        $this->assertTrue($creator->valid);
        $this->assertEquals('http://neverssl.com', $creator->link);
        $this->assertEquals('website_screenshots/neverssl_com.png', $creator->screenshot);
    }

    /**
     * @test
     * @group api
     */
    public function creator_website_can_pull_data_with_https_website_with_www()
    {
        $creator = Creator::create([
            'channel_id' => 'boston.com',
            'creator' => 'boston.com',
            'channel' => 'website',
        ]);
        $processor = new WebsiteProcessor($creator);
        $processor->process();
        $this->assertEquals('boston.com', $creator->name);
        $this->assertLessThan(1000000, $creator->alexa_ranking);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://boston.com', $creator->link);
        $this->assertEquals('website_screenshots/boston_com.png', $creator->screenshot);
    }

    /**
     * @test
     * @group api
     */
    public function creator_website_cannot_pull_data_with_invalid_website()
    {
        $creator = Creator::create([
            'channel_id' => 'dsfsfsfsfsfsfsfssf.com',
            'creator' => 'dsfsfsfsfsfsfsfssf.com',
            'channel' => 'website',
        ]);
        $processor = new WebsiteProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }
}
