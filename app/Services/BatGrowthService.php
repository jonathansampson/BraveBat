<?php

namespace App\Services;

use PHPHtmlParser\Dom;
use Spatie\Browsershot\Browsershot;

class BatGrowthService
{
    public function getData()
    {
        $lookup = [
            'total', 'youtube', 'website', 'twitch', 'twitter', 'reddit', 'vimeo', 'github',
        ];
        $html = Browsershot::url(config('bravebat.bat_growth'))->bodyHtml();
        $dom = new Dom;
        $dom->loadStr($html);
        $contents = $dom->find('strong.big-stats');
        $results = [];
        foreach ($contents as $key => $element) {
            if ($key <= 7) {
                $results[] = preg_replace("/[^0-9]/", "", $element->innerHtml());
            }
        }
        return array_combine($lookup, $results);
    }

}
