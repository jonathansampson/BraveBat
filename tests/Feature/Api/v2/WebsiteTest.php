<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/website';
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
    public function website_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, [
            'dsf' => 'wikipedia.org',
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            'error' => 'missing_field',
            'message' => "The url field is required.",
        ]);
    }

    /** @test */
    public function website_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['url' => 'wikipedia.com']);
        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'not_found',
            'message' => "We cannot find this website creator.",
        ]);
    }

    /** @test */
    public function website_api_success()
    {
        $response = $this->postJson($this->endpoint, ['url' => 'wikipedia.org']);
        $response->assertStatus(200);
        $response->assertJson([
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
        ]);
    }

    /** @test */
    public function website_api_success_with_safeguard()
    {
        $response = $this->postJson($this->endpoint, ['url' => 'http://wikipedia.org/hahah']);
        $response->assertStatus(200);
        $response->assertJson([
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
            "verified" => true,
        ]);
    }
}
