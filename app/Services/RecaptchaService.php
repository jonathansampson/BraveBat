<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    public function verify($recaptcha, $ip)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $response = Http::asForm()->post($url, [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha,
            'remoteip' => $ip
        ]);
        if ($response->ok()) {
            return $response->json();
        }
    }
}
