<?php

namespace App\Tasks\Sitemap;

use App\Models\Creator;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;

class OverallSitemap
{
    const CHUNK = 1000;
    public $filesCount;
    public $folder;
    public $lastCreatorId;

    public function __construct()
    {
        $this->folder = config('bravebat.sitemap_folder');
        $this->lastCreatorId = Creator::orderBy('id', 'desc')->first()->id;
        $this->filesCount = (int) ceil($this->lastCreatorId / self::CHUNK);
    }

    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path($this->folder . '/app.xml'));

        $sitemapIndex = SitemapIndex::create(config('app.url'));
        $sitemapIndex->add($this->folder . '/app.xml');
        for ($i = 0; $i < $this->filesCount; $i++) {
            $sitemapIndex->add($this->folder . "/creators_{$i}.xml");
        }

        $sitemapIndex->writeToFile(public_path('sitemap.xml'));

    }
}
