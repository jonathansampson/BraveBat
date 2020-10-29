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

    // public function getBatPurchases()
    // {
    //     $rows = $this->dom->find('.recent-transactions table tr');
    //     $results = [];
    //     foreach ($rows as $key => $row) {
    //         $elements = $row->find('td');
    //         $result = [];

    //         foreach ($elements as $key => $td) {
    //             if ($key == 0) {
    //                 $result['transaction_date'] = $td->text;
    //             } elseif ($key == 1) {
    //                 $result['transaction_amount'] = str_replace(',', '', $td->text);
    //             } elseif ($key == 2) {
    //                 $links = $td->find('a');
    //                 foreach ($links as $key1 => $link) {
    //                     $result['transaction_record'] = $link->text;
    //                 }
    //             }
    //         }
    //         if (count($result) == 3) {
    //             array_push($results, $result);
    //         }
    //     }
    //     return $results;
    // }

}
