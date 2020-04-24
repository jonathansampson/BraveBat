<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BackFillGithubDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Github Data';

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
        SimpleScheduledTaskSlackAndLogService::message('start Github filling');
        Creator::whereNull('last_processed_at')
            ->where('channel', 'github')
            ->take(10)
            ->get()
            ->each(function ($creator, $key) {
                $creator->processCreatable();
                sleep(2);
            });
        SimpleScheduledTaskSlackAndLogService::message('finish Github filling');
    }
}