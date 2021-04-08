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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {--full}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemaps';

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
     * @return mixed
     */
    public function handle()
    {
        $fullScan = $this->option('full');

        SitemapIndex::create(config('app.url'))
            ->add('/storage/app_sitemap.xml')
            ->add('/storage/creators_sitemap.xml')
            ->writeToFile(public_path('sitemap.xml'));

        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path('storage/app_sitemap.xml'));
        if ($fullScan) {
            $this->generateCreatorSitemapIndex();
        }
    }

    public function generateCreatorSitemapIndex()
    {
        $sitemapIndex = SitemapIndex::create(config('app.url'));
        $count = 0;
        Creator::chunk(5000, function ($creators) use (&$count, &$sitemapIndex) {
            $sitemap = $this->generateCreatorSitemap($creators, $count);
            $count++;
            $sitemapIndex->add($sitemap);
        });
        $sitemapIndex->writeToFile(public_path('storage/creators_sitemap.xml'));

    }

    public function generateCreatorSitemap($chunk, $index)
    {
        $sitemap = Sitemap::create(config('app.url'));
        $fileName = "storage/creators_{$index}.xml";
        foreach ($chunk as $creator) {
            $sitemap->add(Url::create(route('creators.show', [$creator->channel, $creator->id]))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.1));
        }
        $sitemap->writeToFile(public_path($fileName));
        sleep(300);
        return $fileName;
    }
}
