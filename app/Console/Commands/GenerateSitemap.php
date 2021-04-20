<?php

namespace App\Console\Commands;

use App\Tasks\Sitemap\CreatorSitemap;
use App\Tasks\Sitemap\OverallSitemap;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{

    protected $signature = 'sitemap:generate {--full}';

    protected $description = 'Generate the sitemaps';

    public function handle()
    {
        $fullScan = $this->option('full');

        (new OverallSitemap())->handle();
        if ($fullScan) {
            (new CreatorSitemap)->handle();
        }
    }

}
