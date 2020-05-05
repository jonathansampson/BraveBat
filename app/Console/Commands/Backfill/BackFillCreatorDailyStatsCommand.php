<?php

namespace App\Console\Commands\Backfill;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use App\Models\Stats\CreatorDailyStats;

class BackFillCreatorDailyStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill:daily_stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill Creator Daily Stats';

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
        $period = CarbonPeriod::create('2020-04-18', '2020-05-04');
        foreach ($period as $date) {
            CreatorDailyStats::generate($date->toDateString());
        }
    }
}
