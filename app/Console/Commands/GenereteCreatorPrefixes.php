<?php

namespace App\Console\Commands;

use App\Models\CreatorPrefix;
use Illuminate\Console\Command;

class GenereteCreatorPrefixes extends Command
{
    protected $signature = 'prefix:generate';

    protected $description = 'Generate Prefixes';

    public function handle()
    {
        CreatorPrefix::generate();
    }
}
