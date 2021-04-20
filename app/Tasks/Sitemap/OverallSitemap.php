<?php

namespace App\Tasks\Sitemap;

use Spatie\Crawler\Crawler;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;

class OverallSitemap
{
    public $folder;

    public function __construct()
    {
        $this->folder = config('bravebat.sitemap_folder');
    }

    public function handle()
    {
        SitemapIndex::create(config('app.url'))
            ->add($this->folder . '/app.xml')
            ->add($this->folder . '/creators.xml')
            ->writeToFile(public_path('sitemap.xml'));

        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path($this->folder . '/app.xml'));
    }
}
