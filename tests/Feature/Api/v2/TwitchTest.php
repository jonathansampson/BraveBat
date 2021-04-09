<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwitchTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/twitch';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'twitch',
            'channel_id' => '12345',
            'name' => 'hello',
            'display_name' => 'Some display name',
            'description' => 'some description',
            'link' => 'https://twitch.com/12345',
            'follower_count' => 10,
            'view_count' => 1000,
        ]);
    }

    /** @test */
    public function twitch_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['error' => "missing_field", 'message' => "The twitch id field is required."]);
    }

    /** @test */
    public function twitch_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['twitch_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['error' => "not_found", 'message' => "We cannot find this twitch creator."]);
    }

    /** @test */
    public function twitch_api_success()
    {
        $response = $this->postJson($this->endpoint, ['twitch_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'hello',
            'display_name' => 'Some display name',
            'description' => 'some description',
            'link' => 'https://twitch.com/12345',
            'followers' => 10,
            'views' => 1000,
            'verified' => true,
        ]);
    }
}
