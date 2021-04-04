<?php

namespace Tests\Unit\Models\CreatorProcessors;

use App\Models\Creator;
use App\Models\CreatorProcessors\WebsiteProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
    }

}
