<?php

namespace Tests\Unit\Services;

use App\Services\EthplorerService;
use Tests\TestCase;

class EthplorerApiServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function it_can_get_ethplorer_data()
    {
        $service = new EthplorerService();
        $response = $service->getStats();
        $this->assertTrue($response['success']);
    }
}
