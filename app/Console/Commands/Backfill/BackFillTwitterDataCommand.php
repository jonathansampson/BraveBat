<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BackFillTwitterDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Twitter Data';

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
        SimpleScheduledTaskSlackAndLogService::message('start Twitter filling');
        Creator::whereNull('creatable_id')
            ->where('creator', 'like', '%twitter#channel%')
            ->take(1000)
            ->get()
            ->each(function ($creator, $key) {
                $creator->fillChannel();
                $creator->processCreatable();
                sleep(6);
            });
        SimpleScheduledTaskSlackAndLogService::message('start Twitter filling');
    }
}
