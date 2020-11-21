<?php

namespace App\Console\Commands\Backfill;

use App\Models\Creator;
use App\Services\SimpleScheduledTaskSlackAndLogService;
use Illuminate\Console\Command;

class BackfillAllDataCommand extends Command
{
    protected $signature = 'backfill:all';

    protected $description = 'Backfill All Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach ($this->channels() as $channel => $element) {
            SimpleScheduledTaskSlackAndLogService::message("start {$channel} filling");
            $updatableCreators = Creator::where('updated_at', '<', now()->subDay($element['gap']))
                ->where('channel', $channel)
                ->orderBy('id', 'asc')
                ->take($element['take'])
                ->get();
            foreach ($updatableCreators as $creator) {
                $creator->processCreatable();
                sleep($element['sleep']);
            }
            SimpleScheduledTaskSlackAndLogService::message("finish {$channel} filling");
        }
    }

    public function channels()
    {
        return [
            // 'website' => [
            //     'take' => 2000,
            //     'sleep' => 0,
            //     'gap' => 90,
            // ],
            'youtube' => [
                'take' => 10000,
                'sleep' => 0,
                'gap' => 40,
            ],
            'github' => [
                'take' => 1000,
                'sleep' => 6,
                'gap' => 80,
            ],
            'twitter' => [
                'take' => 1000,
                'sleep' => 6,
                'gap' => 70,
            ],
            'vimeo' => [
                'take' => 1000,
                'sleep' => 6,
                'gap' => 60,
            ],
            'twitch' => [
                'take' => 1000,
                'sleep' => 6,
                'gap' => 50,
            ],
        ];
    }
}
