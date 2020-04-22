<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

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
        SimpleScheduledTaskSlackAndLogService::message('start Vimeo filling');
        Creator::whereNull('creatable_id')
            ->where('creator', 'like', '%vimeo#channel%')
            ->take(1000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                $creator->processCreatable();
                sleep(5);
            });
        SimpleScheduledTaskSlackAndLogService::message('finish Vimeo filling');
    }
}
