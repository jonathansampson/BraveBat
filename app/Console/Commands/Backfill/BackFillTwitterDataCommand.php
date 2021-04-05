<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;
use Illuminate\Console\Command;

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
        $take = config('bravebat.daily_backfill_take.twitter');
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
            sleep(5);
        });
    }
}
