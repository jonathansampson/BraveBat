<?php

namespace App\Console\Commands\Api;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateApiDocsCommand extends Command
{
    protected $signature = 'api_docs:generate';

    protected $description = 'Generate API Docs';

    public function handle()
    {
        $openapi = \OpenApi\scan(app_path('Api/v2'));
        Storage::disk('public')->put('api.v2.yaml', $openapi->toYaml());
        Storage::disk('public')->put('api.v2.json', $openapi->toJson());
    }
}
