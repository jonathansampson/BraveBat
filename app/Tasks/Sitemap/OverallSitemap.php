<?php

namespace App\Tasks\Sitemap;

use Spatie\Crawler\Crawler;
use Spatie\Sitemap\SitemapGenerator;

class OverallSitemap
{
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
