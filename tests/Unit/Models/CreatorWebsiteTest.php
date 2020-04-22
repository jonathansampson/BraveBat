<?php

namespace Tests\Unit\Models;

use App\Models\Creators\Website;
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
        $website = Website::create(['name' => 'wikipedia.org']);
        $creator = $website->creator()->create(['creator' => 'Something']);
        $website->callApi();
        $this->assertEquals($creator->fresh()->name, "wikipedia.org");
    }

    /**
     * @test
     * @group api
     */
    public function creator_website_can_pull_data_with_http_website()
    {
        $website = Website::create(['name' => 'neverssl.com']);
        $creator = $website->creator()->create(['creator' => 'Something']);
        $website->callApi();
        $this->assertEquals($creator->fresh()->name, "neverssl.com");
    }

    /**
     * @test
     * @group api
     */
    public function creator_website_cannot_pull_data_with_invalid_website()
    {
        $website = Website::create(['name' => 'dsfsfsfsfsfsfsfssf.com']);
        $creator = $website->creator()->create(['creator' => 'Something']);
        $website->callApi();
        $this->assertNull($creator->fresh()->name);
    }
}
