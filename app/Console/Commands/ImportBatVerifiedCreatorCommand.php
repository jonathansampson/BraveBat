<?php

namespace App\Console\Commands;

use App\Services\BraveVerifiedCreatorService;
use Illuminate\Console\Command;

class ImportBatVerifiedCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:bat_creator';

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
        BraveVerifiedCreatorService::import();
    }
}
