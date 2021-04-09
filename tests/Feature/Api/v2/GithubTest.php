<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GithubTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/github';
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
    public function github_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson([
            'error' => "missing_field",
            'message' => "The github id field is required.",
        ]);
    }

    /** @test */
    public function github_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['github_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson([
            'error' => "not_found",
            'message' => "We cannot find this github creator.",
        ]);

    }

    /** @test */
    public function github_api_success()
    {
        $response = $this->postJson($this->endpoint, ['github_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'some name',
            'display_name' => 'some display name',
            'description' => 'some description',
            'link' => 'https://github.com/husonghua',
            'followers' => 10,
            'repos' => 1,
            "verified" => true,
        ]);
    }
}
