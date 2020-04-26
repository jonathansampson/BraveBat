<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;


class BackFillWebsiteDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill website Data';

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
        SimpleScheduledTaskSlackAndLogService::message('start website filling');
        Creator::whereNull('last_processed_at')
            ->where('channel', 'website')
            ->take(8000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->processCreatable();
            });
        SimpleScheduledTaskSlackAndLogService::message('finish website filling');
    }
}
