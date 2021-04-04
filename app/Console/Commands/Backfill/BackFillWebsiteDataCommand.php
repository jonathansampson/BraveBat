<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;
use Illuminate\Console\Command;

class BackFillWebsiteDataCommand extends Command
{
    protected $signature = 'backfill:website';

    protected $description = 'Backfill website Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $take = 8000;
        SimpleScheduledTaskSlackAndLogService::message('start Website filling');
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', 'website')
            ->take($take)
            ->get();
        $this->process($newCreators);

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay(60))
            ->where('channel', 'website')
            ->orderBy('id', 'asc')
            ->take($take - $newCreators->count())
            ->get();
        $this->process($updatableCreators);

        SimpleScheduledTaskSlackAndLogService::message('finish Website filling');
    }

    private function process($creators)
    {
        $creators->each(function ($creator, $key) {
            $creator->processCreatable();
            sleep(1);
        });
    }
}
