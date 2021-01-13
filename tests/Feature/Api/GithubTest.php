<?php

namespace Tests\Feature\Api;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GithubTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v1/github';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'github',
            'channel_id' => '12345',
            'name' => 'some name',
            'display_name' => 'some display name',
            'description' => 'some description',
            'link' => 'https://github.com/husonghua',
            'follower_count' => 10,
            'repo_count' => 1,
        ]);
    }

    /** @test */
    public function github_api_reject_unauthenticated_call()
    {
        $response = $this->postJson($this->endpoint, ['github_id' => '1234']);
        $response->assertStatus(401);
    }

    /** @test */
    public function github_api_reject_missing_field()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['success' => false, 'message' => "Missing required field"]);
    }

    /** @test */
    public function github_api_reject_not_found()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['github_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['success' => false, 'message' => "Not found"]);
    }

    /** @test */
    public function github_api_success()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['github_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'name' => 'some name',
            'display_name' => 'some display name',
            'description' => 'some description',
            'link' => 'https://github.com/husonghua',
            'followers' => 10,
            'repos' => 1,
        ]]);
    }
}
