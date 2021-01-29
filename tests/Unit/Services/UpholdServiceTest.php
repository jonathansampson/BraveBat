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
        $response = $service->getDollarAmount('https://uphold.com/reserve/transactions/c7b2d69c-f1de-4bd1-85b1-cb97f9cbf53c');
        $this->assertEquals(77451.58, $response);
    }

}
