<?php

namespace Tests\Unit\Services;

use App\Services\GithubService;
use Tests\TestCase;

class GithubServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function github_service_can_get_a_github_user_info_with_a_valid_id()
    {
        $service = new GithubService;
        $response = $service->getUser(4323180);
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['name'], "adamwathan");
        $this->assertEquals($response['result']['display_name'], "Adam Wathan");
    }

    /**
     * @test
     * @group api
     */
    public function github_service_cannot_get_a_github_user_info_with_an_invalid_id()
    {
        $service = new GithubService;
        $response = $service->getUser(432318989898980);
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], "User not found");
    }
}
