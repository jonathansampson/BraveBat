<?php

namespace Tests\Feature\Api;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v1/website';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'website',
            'channel_id' => 'wikipedia.org',
            'name' => 'wikipedia.org',
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
            'screenshot' => 'website_screenshots/wikipedia_org.png',
        ]);
    }

    /** @test */
    public function website_api_reject_unauthenticated_call()
    {
        $response = $this->postJson($this->endpoint, ['url' => 'wikipedia.org']);
        $response->assertStatus(401);
    }

    /** @test */
    public function website_api_reject_missing_field()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['dsf' => 'wikipedia.org']);
        $response->assertStatus(422);
        $response->assertJson(['success' => false, 'message' => "Missing required field"]);
    }

    /** @test */
    public function website_api_reject_not_found()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['url' => 'wikipedia.com']);
        $response->assertStatus(404);
        $response->assertJson(['success' => false, 'message' => "Not found"]);
    }

    /** @test */
    public function website_api_success()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['url' => 'wikipedia.org']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
        ]]);
    }

    /** @test */
    public function website_api_success_with_safeguard()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson($this->endpoint, ['url' => 'http://wikipedia.org/hahah']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
        ]]);
    }
}
