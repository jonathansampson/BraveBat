<?php

namespace Tests\Unit\Services;

use App\Services\RedditService;
use Tests\TestCase;

class RedditServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function reddit_service_can_get_data_from_a_valid_subreddit()
    {
        $service = new RedditService;
        $response = $service->getSubreddit('brave_browser');
        $this->assertTrue($response['success']);
        $this->assertGreaterThan(20000, $response['result']['subscribers']);
    }
}
