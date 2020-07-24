<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use Illuminate\Console\Command;
use App\Services\SimpleScheduledTaskSlackAndLogService;

class BackFillVimeoDataCommand extends Command
{
    protected $signature = 'backfill:vimeo';
    protected $description = 'Backfill Vimeo Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $take = 10000;
        SimpleScheduledTaskSlackAndLogService::message('start Vimeo filling');
        $newCreators = Creator::whereNull('last_processed_at')
            ->where('channel', 'vimeo')
            ->take($take)
            ->get();
        $this->process($newCreators);

        $updatableCreators = Creator::where('updated_at', '<', now()->subDay(60))
            ->where('channel', 'vimeo')
            ->orderBy('id', 'asc')
            ->take($take - $newCreators->count())
            ->get();
        $this->process($updatableCreators);

        SimpleScheduledTaskSlackAndLogService::message('finish Vimeo filling');
    }

    private function process($creators)
    {
        $creators->each(function ($creator, $key) {
            $creator->processCreatable();
            sleep(5);
        });
    }
}
