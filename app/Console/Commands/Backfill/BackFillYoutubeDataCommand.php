<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;
use Illuminate\Console\Command;

class BackFillYoutubeDataCommand extends Command
{
    protected $signature = 'backfill:youtube';

    protected $description = 'Backfill Youtube Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $take = 20000;
        SimpleScheduledTaskSlackAndLogService::message('start Youtube filling');
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', 'youtube')
            ->take($take)
            ->get();
        $this->process($newCreators);

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay(60))
            ->where('channel', 'youtube')
            ->orderBy('id', 'asc')
            ->take($take - $newCreators->count())
            ->get();
        $this->process($updatableCreators);

        SimpleScheduledTaskSlackAndLogService::message('finish Youtube filling');
    }

    private function process($creators)
    {
        $creators->each(function ($creator, $key) {
            $creator->processCreatable();
        });
    }
}
