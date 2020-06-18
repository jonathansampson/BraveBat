<?php

namespace App\Console\Commands;

use App\Models\Stats\BatStats;
use Illuminate\Console\Command;

class GenerateBatStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bat_stats:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Daily Bat Stats';

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
        BatStats::generate();
    }
}
