<?php

namespace App\Console\Commands;

use App\Models\BatPurchase;
use App\Models\BraveAdCampaign;
use Illuminate\Console\Command;

class ImportBatTransparencyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bat_transparency:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Bat Transparency Stats';

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
        BatPurchase::import();
        sleep(5);
        BraveAdCampaign::import();
    }
}
