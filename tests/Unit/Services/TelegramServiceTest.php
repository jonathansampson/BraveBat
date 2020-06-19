<?php

namespace Tests\Unit\Services;

use App\Services\TelegramService;
use Tests\TestCase;

class TelegramServiceTest extends TestCase
{
    /**
     * @test
     * @group api
     */
    public function telegram_service_can_get_data_from_a_valid_chat_id()
    {
        $service = new TelegramService;
        $response = $service->getChatMembersCount('batproject');
        $this->assertTrue($response['success']);
        $this->assertGreaterThan(15000, $response['result']['subscribers']);
    }
}
