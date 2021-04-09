<?php

namespace App\Console\Commands;

use App\Models\CreatorPrefix;
use App\Services\BraveProtoApiService;
use Illuminate\Console\Command;

class SyncCreatorPrefixes extends Command
{
    protected $signature = 'prefix:sync';

    protected $description = 'Sync Prefixes';

    public function handle(BraveProtoApiService $service)
    {
        $prefixes = $service->getPrefixes();
        CreatorPrefix::sync($prefixes);
    }
}
