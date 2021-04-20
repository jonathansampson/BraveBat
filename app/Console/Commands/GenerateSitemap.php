<?php

namespace App\Console\Commands;

use App\Models\Creator;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    const FOLDER = '/storage/sitemaps';
    const CHUNK = 1000;

    protected $signature = 'sitemap:generate {--full}';

    protected $description = 'Generate the sitemaps';

    public function handle()
    {
        $fullScan = $this->option('full');

        SitemapIndex::create(config('app.url'))
            ->add(self::FOLDER . '/app.xml')
            ->add(self::FOLDER . '/creators.xml')
            ->writeToFile(public_path('sitemap.xml'));

        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path(self::FOLDER . '/app.xml'));

        if ($fullScan) {
            $this->generateCreatorSitemapIndex();
        }
    }

    public function generateCreatorSitemapIndex()
    {
        $lastCreatorId = Creator::orderBy('id', 'desc')->first()->id;
        $filesCount = (int) ceil($lastCreatorId / self::CHUNK);
        $sitemapIndex = SitemapIndex::create(config('app.url'));

        for ($i = 0; $i < $filesCount; $i++) {
            $sitemapIndex->add(self::FOLDER . "/creators_{$i}.xml");
        }
        $sitemapIndex->writeToFile(public_path(self::FOLDER . "/creators.xml"));

        $segment = Carbon::now()->day - 1;
        for ($i = 100 * $segment; $i < 100 * ($segment + 1); $i++) {
            $sitemap = Sitemap::create(config('app.url'));
            $fileName = self::FOLDER . "/creators_{$i}.xml";
            $creators = Creator::where('id', ">=", $i * self::CHUNK)->where("id", "<", ($i + 1) * self::CHUNK)->get();

            if (!$creators->count()) {
                break;
            }

            foreach ($creators as $creator) {
                $sitemap->add(Url::create(route('creators.show', [$creator->channel, $creator->id]))
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.1));
            }
            $sitemap->writeToFile(public_path($fileName));
            sleep(3);
        }
    }
}
