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
        $take = 10000;
        SimpleScheduledTaskSlackAndLogService::message('start Github filling');
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', 'github')
            ->take($take)
            ->get();
        $this->process($newCreators);

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay(60))
            ->where('channel', 'github')
            ->orderBy('id', 'asc')
            ->take($take - $newCreators->count())
            ->get();
        $this->process($updatableCreators);
        SimpleScheduledTaskSlackAndLogService::message('finish Github filling');
    }

    private function process($creators)
    {
        $creators->each(function ($creator, $key) {
            $creator->processCreatable();
            sleep(10);
        });
    }
}
