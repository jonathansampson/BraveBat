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
            ->add('/storage/sitemaps/app.xml')
            ->add('/storage/sitemaps/creators.xml')
            ->writeToFile(public_path('sitemap.xml'));

        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(1);
            })
            ->writeToFile(public_path('storage/sitemaps/app.xml'));
        if ($fullScan) {
            $this->generateCreatorSitemapIndex();
        }
    }

    public function generateCreatorSitemapIndex()
    {
        $lastCreatorId = Creator::orderBy('id', 'desc')->first()->id;
        $filesCount = (int) ceil($lastCreatorId / 1000);
        $sitemapIndex = SitemapIndex::create(config('app.url'));

        for ($i = 0; $i < $filesCount; $i++) {
            $sitemapIndex->add("storage/sitemaps/creators_{$i}.xml");
        }
        $sitemapIndex->writeToFile(public_path('storage/sitemaps/creators.xml'));

        for ($i = 0; $i < $filesCount; $i++) {
            $sitemap = Sitemap::create(config('app.url'));
            $fileName = "storage/sitemaps/creators_{$i}.xml";
            $creators = Creator::where('id', ">=", $i * 1000)->where("id", "<=", ($i + 1) * 1000)->get();
            foreach ($creators as $creator) {
                $sitemap->add(Url::create(route('creators.show', [$creator->channel, $creator->id]))
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.1));
            }
            $sitemap->writeToFile(public_path($fileName));
        }
    }
}
