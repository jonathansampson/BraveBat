<?php

namespace App\Services;

use Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduledCommandFinished;

class SimpleScheduledTaskSlackAndLogService
{
    public static function message($message)
    {
        Log::info($message);
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new ScheduledCommandFinished($message));
    }
}
