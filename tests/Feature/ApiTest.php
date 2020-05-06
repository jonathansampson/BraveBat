<?php

namespace Tests\Feature;

use App\Models\Creator;
use App\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 
     * Test Website endpoint
     * @test
     * @return void
     */
    public function website_api_endpoint()
    {
        // Unauthendicated
        $response = $this->postJson('/api/website', ['url' => 'wikipedia.org']);
        $response->assertStatus(401);

        factory(Creator::class)->create([
            'channel' => 'website',
            'name' => 'wikipedia.org',
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
            'screenshot' => 'website_screenshots/wikipedia_org.png'
        ]);

        Sanctum::actingAs(
            factory(User::class)->create(),
        );

        // Missing field
        $response = $this->postJson('/api/website', ['dsf' => 'wikipedia.org']);
        $response->assertStatus(422);
        $response->assertJson(['success' => false, 'message' => "Missing required field"]);

        // Not found
        $response = $this->postJson('/api/website', ['url' => 'wikipedia.com']);
        $response->assertStatus(404);
        $response->assertJson(['success' => false, 'message' => "Not found"]);

        // Success
        $response = $this->postJson('/api/website', ['url' => 'wikipedia.org']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
        ]]);

        // Success variation
        $response = $this->postJson('/api/website', ['url' => 'http://wikipedia.org/hahah']);
        $response->assertStatus(200);
        $response->assertJson(['success' => true, 'data' => [
            'link' => 'https://wikipedia.org',
            'alexa_ranking' => 10,
        ]]);
    }
}
