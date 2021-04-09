<?php

namespace Tests\Feature\Api\v1;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TwitterTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v1/twitter';
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
    public function twitter_api_reject_unauthenticated_call()
    {
        $response = $this->postJson($this->endpoint, ['twitter_id' => '1234']);
        $response->assertStatus(401);
    }

    /** @test */
    public function twitter_api_reject_missing_field()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['success' => false, 'message' => "Missing required field"]);
    }

    /** @test */
    public function twitter_api_reject_not_found()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['twitter_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['success' => false, 'message' => "Not found"]);
    }

    /** @test */
    public function twitter_api_success()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['twitter_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'handle' => 'bravebatinfo',
            'display_name' => 'bravebatinfo display',
            'description' => 'some description',
            'link' => 'https://twitter.com/bravebatinfo',
            'followers' => 10,
        ]]);
    }
}
