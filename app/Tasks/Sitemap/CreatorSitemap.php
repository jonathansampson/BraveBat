<?php

namespace App\Tasks\Sitemap;

use App\Models\Creator;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class CreatorSitemap
{
    const CHUNK = 1000;
    const TAKE = 100;
    public $filesCount;
    public $folder;
    public $lastCreatorId;

    public function __construct()
    {
        $this->lastCreatorId = Creator::orderBy('id', 'desc')->first()->id;
        $this->folder = config('bravebat.sitemap_folder');
        $this->filesCount = (int) ceil($this->lastCreatorId / self::CHUNK);
    }

    public function handle()
    {
        $this->createIndexSitemap();
        $this->createShowSitemap();
    }

    public function createIndexSitemap()
    {
        $sitemapIndex = SitemapIndex::create(config('app.url'));
        for ($i = 0; $i < $this->filesCount; $i++) {
            $sitemapIndex->add($this->folder . "/creators_{$i}.xml");
        }
        $sitemapIndex->writeToFile(public_path($this->folder . "/creators.xml"));
    }

    public function createShowSitemap()
    {
// $segment = Carbon::now()->day - 1;
        $segment = 3;
        if ($segment * self::CHUNK * self::TAKE > $this->lastCreatorId) {
            return;
        }
        for ($i = self::TAKE * $segment; $i < self::TAKE * ($segment + 1); $i++) {
            $sitemap = Sitemap::create(config('app.url'));
            $fileName = $this->folder . "/creators_{$i}.xml";
            $creators = Creator::where('id', ">=", $i * self::CHUNK)->where("id", "<", ($i + 1) * self::CHUNK)->get();

            foreach ($creators as $creator) {
                $sitemap->add(Url::create(route('creators.show', [$creator->channel, $creator->id]))
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.1));
            }
            $sitemap->writeToFile(public_path($fileName));
            sleep(1);
        }
    }
}
