<?php

namespace App\Console\Commands\Backfill;

use App\Services\SimpleScheduledTaskSlackAndLogService;
use App\Tasks\CreatorProcessingTask;
use Illuminate\Console\Command;

class BackfillAllDataCommand extends Command
{
    protected $signature = 'creator:process';

    protected $description = 'Process creator data';

    public function handle()
    {
        foreach ($this->channels() as $channel => $config) {
            SimpleScheduledTaskSlackAndLogService::message("start filling" . $channel);
            (new CreatorProcessingTask())
                ->setChannel($channel)
                ->setDays($config['days'])
                ->setTake($config['take'])
                ->setSleep($config['sleep'])
                ->process();
            SimpleScheduledTaskSlackAndLogService::message("finish filling" . $channel);
        }
    }

    public function channels()
    {
        return [
            'website' => [
                'take' => 20000,
                'sleep' => 0,
                'gap' => 30,
            ],
            'youtube' => [
                'take' => 10000,
                'sleep' => 5,
                'gap' => 35,
            ],
            'github' => [
                'take' => 10000,
                'sleep' => 5,
                'gap' => 40,
            ],
            'twitter' => [
                'take' => 10000,
                'sleep' => 5,
                'gap' => 45,
            ],
            'vimeo' => [
                'take' => 10000,
                'sleep' => 5,
                'gap' => 50,
            ],
            'twitch' => [
                'take' => 10000,
                'sleep' => 5,
                'gap' => 55,
            ],
        ];
    }
}
