<?php

namespace Tests\Unit\Services;

use App\Services\BatWatchService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BatWatchServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function it_can_get_data()
    {
        $this->assertEquals(1, 1);
        $data = (new BatWatchService())->getData();
        $this->assertCount(8, $data);
        $this->assertGreaterThan(900000, $data['total']);
    }
}
