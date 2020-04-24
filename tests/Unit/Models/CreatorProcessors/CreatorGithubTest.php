<?php

namespace Tests\Unit\Models\CreatorProcessors;

use Tests\TestCase;
use App\Models\Creator;
use App\Models\CreatorProcessors\GithubProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatorGithubTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group api
     */
    public function creator_github_can_pull_data_with_good_github_id()
    {
        $creator = Creator::create([
            'channel_id' => '4323180',
            'creator' => 'github#channel:4323180',
            'channel' => 'github',
        ]);
        $processor = new GithubProcessor($creator);
        $processor->process();
        $this->assertEquals('adamwathan', $creator->name);
        $this->assertEquals('Adam Wathan', $creator->display_name);
        $this->assertNotNull($creator->description);
        $this->assertNotNull($creator->thumbnail);
        $this->assertGreaterThan(3000, $creator->follower_count);
        $this->assertGreaterThan(80, $creator->repo_count);
        $this->assertTrue($creator->valid);
        $this->assertEquals('https://github.com/adamwathan', $creator->link);
    }

    /**
     * @test
     * @group api
     */
    public function creator_github_cannot_pull_data_with_invalid_github_id()
    {
        $creator = Creator::create([
            'channel_id' => '43231878787870',
            'creator' => 'github#channel:43231878787870',
            'channel' => 'github',
        ]);
        $processor = new GithubProcessor($creator);
        $processor->process();
        $this->assertFalse($creator->valid);
    }
}
