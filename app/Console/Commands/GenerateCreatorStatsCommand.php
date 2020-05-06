<?php

namespace App\Console\Commands;

use App\Models\Stats\CreatorStats;
use Illuminate\Console\Command;

class GenerateCreatorStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creator_stats:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Monthly Creator Stats';

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
        CreatorStats::generate();
    }
}
