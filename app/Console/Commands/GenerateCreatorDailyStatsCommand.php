<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stats\CreatorDailyStats;

class GenerateCreatorDailyStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creator_daily_stats:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Creator Stats';

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
        CreatorDailyStats::generate(today()->toDateString());
        $this->call('cache:clear');
    }
}
