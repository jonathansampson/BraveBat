<?php

namespace App\Console\Commands\Search;

use App\Tasks\CreatorSearchTask;
use Illuminate\Console\Command;

class CreatorsIndexRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creators_search:refresh_index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Creators Search Index';

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
     * @return int
     */
    public function handle(CreatorSearchTask $creatorSearchTask)
    {
        $creatorSearchTask->refresh();
    }
}
