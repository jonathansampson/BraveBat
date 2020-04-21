<?php

namespace App\Console\Commands;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class BackFillCreatorDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creator:backfill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Creator Data';

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
        // Creator::where('id', 57)
        //     ->get()
        //     ->each(function ($creator) {
        //         $creator->fillChannel();
        //         $creator->processCreatable();
        //     });

        Log::notice('start back filling');
        Creator::where('channel', '')
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                // $creator->processCreatable();
            });
        Log::notice('finish back filling');
        Notification::route('slack', config('services.slack.webhook'))
            ->notify(new App\Notifications\ScheduledCommandFinished('Backfill job is done'));

        // Creator::whereNull('creatable_id')
        //     ->where('creator', 'like', '%twitch#author%')
        //     ->take(10)
        //     ->get()
        //     ->each(function ($creator, $key) {
        //         $creator->fillChannel();
        //         $creator->processCreatable();
        //     });
    }
}
