<?php

namespace Tests\Unit\Services;

use App\Services\BatGrowthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BatGrowthServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function it_can_get_data()
    {
        $data = (new BatGrowthService())->getData();
        $this->assertCount(8, $data);
        $this->assertGreaterThan(900000, $data['total']);
    }
}
