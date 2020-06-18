<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\EthplorerService;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
