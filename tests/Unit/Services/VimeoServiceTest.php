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
        $response = $service->getUser('46924634');
        $this->assertTrue($response['success']);
        $this->assertEquals($response['result']['display_name'], "Raship Trikha");
        $this->assertEquals($response['result']['name'], "rashiptrikha");
    }

    /**
     * @test
     * @group api
     */
    public function vimeo_service_cannot_get_data_from_an_invalid_id()
    {
        $service = new VimeoService;
        $response = $service->getUser('4692463428938492894832');
        $this->assertFalse($response['success']);
        $this->assertEquals($response['result'], "User not found");
    }
}
