<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedditTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/reddit';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'reddit',
            'channel_id' => '12345',
        ]);
    }

    /** @test */
    public function reddit_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['error' => 'missing_field', 'message' => "The reddit id field is required."]);
    }

    /** @test */
    public function reddit_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['reddit_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['error' => 'not_found', 'message' => "We cannot find this reddit creator."]);
    }

    /** @test */
    public function reddit_api_success()
    {
        $response = $this->postJson($this->endpoint, ['reddit_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson(['verified' => true]);
    }
}
