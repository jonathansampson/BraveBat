<?php

namespace App\Jobs;

use App\Models\Recaptcha;
use Illuminate\Bus\Queueable;
use App\Services\RecaptchaService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessRecaptcha implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recaptcha;
    protected $ip;
    protected $email;

    /**
     * Create a new job instance.
     * 
     * @param  string  $recaptcha
     * @param  string  $ip
     * @param  string  $email
     * 
     * @return void
     */
    public function __construct($recaptcha, $ip, $email = null)
    {
        $this->recaptcha = $recaptcha;
        $this->ip = $ip;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = (new RecaptchaService())->verify($this->recaptcha, $this->ip);
        if ($response['success']) {
            Recaptcha::create([
                'success' => $response['success'],
                'score' => $response['score'],
                'action' => $response['action'],
                'email' => $this->email
            ]);
        } else {
            Recaptcha::create([
                'success' => $response['success'],
                'error_codes' => json_encode($response['error-codes']),
                'email' => $this->email
            ]);
        }
    }
}
