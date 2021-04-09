<?php

namespace Tests\Feature\Api\v2;

use App\Models\Creator;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VimeoTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/api/v2/creators/vimeo';
        $this->user = User::factory()->create();
        Creator::factory()->create([
            'channel' => 'vimeo',
            'channel_id' => '12345',
            'name' => 'hello',
            'display_name' => 'hello display',
            'description' => 'some description',
            'link' => 'https://vimeo.com/12345',
            'follower_count' => 10,
            'video_count' => 100,
        ]);
    }

    /** @test */
    public function vimeo_api_reject_missing_field()
    {
        $response = $this->postJson($this->endpoint, ['dsf' => '1234']);
        $response->assertStatus(422);
        $response->assertJson(['error' => "missing_field", 'message' => "The vimeo id field is required."]);
    }

    /** @test */
    public function vimeo_api_reject_not_found()
    {
        $response = $this->postJson($this->endpoint, ['vimeo_id' => '1234']);
        $response->assertStatus(404);
        $response->assertJson(['error' => "not_found", 'message' => "We cannot find this vimeo creator."]);
    }

    /** @test */
    public function vimeo_api_success()
    {
        $response = $this->postJson($this->endpoint, ['vimeo_id' => '12345']);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'hello',
            'display_name' => 'hello display',
            'description' => 'some description',
            'link' => 'https://vimeo.com/12345',
            'followers' => 10,
            'videos' => 100,
            "verified" => true,
        ]);
    }
}
