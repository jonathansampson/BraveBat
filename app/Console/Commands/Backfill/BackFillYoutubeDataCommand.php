<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

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
        SimpleScheduledTaskSlackAndLogService::message('start Youtube filling');

        Creator::whereNull('creatable_id')
            ->where('creator', 'like', '%youtube#channel%')
            ->take(2000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                $creator->processCreatable();
            });
        SimpleScheduledTaskSlackAndLogService::message('start Youtube filling');
    }
}
