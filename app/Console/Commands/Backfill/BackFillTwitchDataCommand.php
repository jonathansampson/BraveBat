<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BackFillTwitchDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:twitch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Twitch Data';

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
        SimpleScheduledTaskSlackAndLogService::message('start Twitch filling');
        Creator::where('updated_at', "<=", now()->subDay(3)->toDateTimeString())
            ->where('channel', 'twitch')
            ->orderBy('updated_at', 'asc')
            ->take(10)
            ->get()
            ->each(function ($creator, $key) {
                $creator->processCreatable();
                sleep(3);
            });
        SimpleScheduledTaskSlackAndLogService::message('finish Twitch filling');
    }
}
