<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduledCommandFinished;

class BackFillYoutubeDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:youtube';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Youtube Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::notice('start youtube filling');
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new ScheduledCommandFinished('start youtube filling'));
        Creator::whereNull('creatable_id')
            ->where('creator', 'like', '%youtube#channel%')
            ->take(2000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                $creator->processCreatable();
            });
        Log::notice('finish youtube filling');
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new ScheduledCommandFinished('finish youtube filling'));
    }
}
