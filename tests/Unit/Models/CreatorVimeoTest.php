<?php

namespace Tests\Unit\Models;

use App\Models\Creators\Vimeo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorVimeoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_vimeo_can_pull_data_with_good_vimeo_id()
    {
        $vimeo = Vimeo::create(['vimeo_id' => '46924634']);
        $creator = $vimeo->creator()->create(['creator' => 'Something']);
        $vimeo->callApi();
        $this->assertEquals($vimeo->fresh()->name, "rashiptrikha");
        $this->assertEquals($creator->fresh()->name, "rashiptrikha");
    }

    /**
     * @test
     * @group api
     */
    public function creator_vimeo_cannot_pull_data_with_invalid_vimeo_id()
    {
        $vimeo = Vimeo::create(['vimeo_id' => '3278989898989898']);
        $creator = $vimeo->creator()->create(['creator' => 'Something']);
        $vimeo->callApi();
        $this->assertNull($vimeo->fresh()->name);
        $this->assertNull($creator->fresh()->name);
    }
}
