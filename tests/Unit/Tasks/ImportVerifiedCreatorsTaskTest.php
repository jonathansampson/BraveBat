<?php

namespace Tests\Unit\Tasks;

use App\Models\Creator;
use App\Tasks\ImportVerifiedCreatorsTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportVerifiedCreatorsTaskTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @group brotli
     **/
    public function it_can_handle()
    {
        $task = new ImportVerifiedCreatorsTask();
        $task->handle(['0000']);
        $this->assertGreaterThan(10, Creator::count());
    }
}
