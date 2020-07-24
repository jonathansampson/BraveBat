<?php

namespace App\Console\Commands\Backfill;

use Log;
use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BackFillTwitterDataCommand extends Command
{
    protected $signature = 'backfill:twitter';
    protected $description = 'Backfill Twitter Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $take = 10000;
        SimpleScheduledTaskSlackAndLogService::message('start Twitter filling');
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', 'twitter')
            ->take($take)
            ->get();
        $this->process($newCreators);

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay(60))
            ->where('channel', 'twitter')
            ->orderBy('id', 'asc')
            ->take($take - $newCreators->count())
            ->get();
        $this->process($updatableCreators);

        SimpleScheduledTaskSlackAndLogService::message('finish Twitter filling');
    }

    private function process($creators)
    {
        $creators->each(function ($creator, $key) {
            $creator->processCreatable();
            sleep(6);
        });
    }
}
