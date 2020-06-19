<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    public function getChatMembersCount($community)
    {

        $url = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . '/getChatMembersCount?chat_id=@' . $community;
        $response = Http::get($url);
        if ($response->ok()) {
            return [
                'success' => true,
                'result' => [
                    'subscribers' => $response->json()['result']
                ]
            ];
        }
    }
}
