<?php

namespace Tests\Unit\Services;

use App\Models\Creator;
use App\Services\CreatorSearchService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatorSearchServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @group api
     */
    public function it_can_do_search()
    {
        Creator::factory()->times(10)->create(['ranking' => 1]);
        $songhua = Creator::factory()->create([
            'name' => 'songhuasonghuasonghua',
            'ranking' => 0,
        ]);

        $service = new CreatorSearchService("test_creator");
        $service->updateRankingRules();
        $service->updateSearchableAttributes();
        $creatorsArray = Creator::all()->map(function ($creator) {
            return $creator->toSearchArray();
        })->toArray();
        $service->addDocument($creatorsArray);
        sleep(1);

        $results = $service->search('songhuasonghuasonghua');
        $this->assertEquals(1, count($results));
        $service->deleteDocument($songhua->id);
        sleep(1);

        $results = $service->search('songhuasonghuasonghua');
        $this->assertEquals(0, count($results));
        $service->deleteIndex();
    }
}
