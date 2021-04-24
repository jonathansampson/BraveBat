<?php

namespace App\Jobs;

use App\Models\BatPurchase;
use App\Services\TweetService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBatPurchase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batPurchase;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BatPurchase $batPurchase)
    {
        $this->batPurchase = $batPurchase;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TweetService $tweetService)
    {
        $this->batPurchase->fetchDollarAmount();
        $tweetService->postTweet($this->tweetMessage());
    }
}
