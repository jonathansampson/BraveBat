<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BraveApiService;
use App\Models\Stats\CreatorDailyStats;

class ImportBatVerifiedCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:creator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import BAT verified creators';

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
        BraveApiService::import();
        CreatorDailyStats::generate(Carbon::today()->toDateString());
    }
}
