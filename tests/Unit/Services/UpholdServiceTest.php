<?php

namespace Tests\Unit\Services;

use App\Services\UpholdService;
use Tests\TestCase;

class UpholdServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function uphold_service_can_get_data()
    {
        $service = new UpholdService();
        $response = $service->getDollarAmount('https://uphold.com/reserve/transactions/576d1d41-5339-40fb-9c2a-84884023c49f');
        $this->assertEquals(100000, $response);
    }

}
