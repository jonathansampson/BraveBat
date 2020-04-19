<?php

namespace Tests\Unit\Services;

use App\Services\VimeoService;
use Tests\TestCase;

class VimeoServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function vimeo_service_can_get_data_from_a_valid_id()
    {
        $service = new VimeoService;
        $response = $service->getUser('rashiptrikha');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['name'], "Raship Trikha");
    }

    /**
     * @test
     * @group api
     */
    public function vimeo_service_cannot_get_data_from_an_invalid_id()
    {
        $service = new VimeoService;
        $response = $service->getUser('rashiptrikdfdfddfdha');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], "User not found");
    }
}
