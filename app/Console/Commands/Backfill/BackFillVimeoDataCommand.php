<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ScheduledCommandFinished;

class BackFillVimeoDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:vimeo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Vimeo Data';

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
        Log::notice('start Vimeo filling');
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new ScheduledCommandFinished('start Vimeo filling'));
        Creator::whereNull('creatable_id')
            ->where('creator', 'like', '%vimeo#channel%')
            ->take(2000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                $creator->processCreatable();
                sleep(5);
            });
        Log::notice('finish Vimeo filling');
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new ScheduledCommandFinished('finish Vimeo filling'));
    }
}
