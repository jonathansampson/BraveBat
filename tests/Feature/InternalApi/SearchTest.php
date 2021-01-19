<?php

namespace Tests\Feature\InternalApi;

use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    protected $endpoint;

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = '/search';
        Creator::factory()->create([
            'channel' => 'youtube',
            'channel_id' => '12345',
            'name' => 'hello',
            'ranking' => 12,
            'valid' => true,
            'description' => 'some description',
            'link' => 'https://youtube.com/12345',
            'follower_count' => 10,
        ]);
    }

    /** @test */
    public function it_can_search_based_on_query_term()
    {
        $response = $this->postJson($this->endpoint, ['term' => 'hello']);
        $response->assertStatus(200);
        $results = $response->json();
        $this->assertCount(1, $results);
        $this->assertEquals('youtube', $results[0]['channel']);
        $this->assertEquals('hello', $results[0]['name']);
    }
}
