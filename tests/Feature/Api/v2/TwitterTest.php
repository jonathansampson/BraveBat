<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwitterTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/twitter';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'twitter',
            'channel_id' => '12345',
            'name' => 'bravebatinfo',
            'display_name' => 'bravebatinfo display',
            'description' => 'some description',
            'link' => 'https://twitter.com/bravebatinfo',
            'follower_count' => 10,
        ]);
    }

    /** @test */
    public function twitter_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['error' => "missing_field", 'message' => "The twitter id field is required."]);
    }

    /** @test */
    public function twitter_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['twitter_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['error' => "not_found", 'message' => "We cannot find this twitter creator."]);
    }

    /** @test */
    public function twitter_api_success()
    {
        $response = $this->postJson($this->endpoint, ['twitter_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson([
            'handle' => 'bravebatinfo',
            'display_name' => 'bravebatinfo display',
            'description' => 'some description',
            'link' => 'https://twitter.com/bravebatinfo',
            'followers' => 10,
            'verified' => true,
        ]);
    }
}
