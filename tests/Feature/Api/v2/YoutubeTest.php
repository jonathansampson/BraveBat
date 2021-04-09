<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YoutubeTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/youtube';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'youtube',
            'channel_id' => '12345',
            'name' => 'hello',
            'description' => 'some description',
            'link' => 'https://youtube.com/12345',
            'follower_count' => 10,
        ]);
    }

    /** @test */
    public function youtube_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['error' => "missing_field", 'message' => "The youtube id field is required."]);
    }

    /** @test */
    public function youtube_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['youtube_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['error' => "not_found", 'message' => "We cannot find this youtube creator."]);
    }

    /** @test */
    public function youtube_api_success()
    {
        $response = $this->postJson($this->endpoint, ['youtube_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'hello',
            'description' => 'some description',
            'link' => 'https://youtube.com/12345',
            'subscribers' => 10,
            "verified" => true,
        ]);
    }
}
