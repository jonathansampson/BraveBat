<?php

namespace App\Console\Commands;

use App\Services\SimpleScheduledTaskSlackAndLogService;
use App\Tasks\ImportVerifiedCreatorsTask;
use Illuminate\Console\Command;

class ImportBatVerifiedCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:creator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import BAT verified creators';

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
        SimpleScheduledTaskSlackAndLogService::message('start importing brave creators');
        $task = (new ImportVerifiedCreatorsTask);
        $task->handle($task->generatePrefixes());
        SimpleScheduledTaskSlackAndLogService::message('Finish importing brave creators');
        // CreatorDailyStats::generate(Carbon::today()->toDateString());
        // $this->call('cache:clear');
    }
}
