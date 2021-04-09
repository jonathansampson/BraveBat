<?php

namespace Tests\Unit\Models;

use App\Models\CreatorPrefix;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorPrefixTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_sync_prefixes()
    {
        CreatorPrefix::factory()->create(['prefix' => 'aaa']);
        CreatorPrefix::factory()->create(['prefix' => 'bbb']);
        CreatorPrefix::factory()->create(['prefix' => 'ccc']);
        CreatorPrefix::sync(['bbb', 'ccc', 'ddd']);
        $this->assertEquals(4, CreatorPrefix::count());
    }
}
