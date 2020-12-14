<?php

namespace App\Services;

use Illuminate\Support\Str;
use PHPHtmlParser\Dom;
use Spatie\Browsershot\Browsershot;

class BatWatchService
{
    public function getData()
    {
        $lookup = [
            'total', 'youtube', 'twitter', 'vimeo', 'reddit', 'twitch', 'website', 'github',
        ];
        $html = Browsershot::url(config('bravebat.bat_watch'))->bodyHtml();
        $dom = new Dom;
        $dom->load($html);
        $contents = $dom->find('div.content');
        $data = $contents[0]->find('div div div div');
        $results = [];
        foreach ($data as $element) {
            $style = $element->getAttribute('style');
            if (Str::contains($style, 'font-size:24px')) {
                $results[] = preg_replace("/[^0-9]/", "", $element->innerHtml());
            }
        }
        return array_combine($lookup, $results);
    }

}
