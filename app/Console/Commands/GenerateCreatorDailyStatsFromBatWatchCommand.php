<?php

namespace App\Console\Commands;

use App\Tasks\GenerateCreateDailyStatsFromBatWatch;
use Illuminate\Console\Command;

class GenerateCreatorDailyStatsFromBatWatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creator_daily_stats:generate_from_bat_watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Creator Stats from Bat Watch';

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
        app(GenerateCreateDailyStatsFromBatWatch::class)->generate();
    }
}
