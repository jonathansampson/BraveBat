<?php

namespace App\Console\Commands\Ads;

use App\Services\BraveCatalogService;
use Illuminate\Console\Command;

class SyncAdsDataCommand extends Command
{
    protected $signature = 'ads:sync';

    protected $description = 'Sync Ads Data';

    public function handle()
    {
        (new BraveCatalogService)->handle();
    }
}
