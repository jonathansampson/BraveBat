<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;
use PHPHtmlParser\Dom;

class BraveTransparencyService
{
    public $dom;

    public function __construct()
    {
        $this->getPage();
    }

    public function getPage()
    {
        $html = Browsershot::url(config('bravebat.transparency_page'))->waitUntilNetworkIdle()->bodyHtml();
        $this->dom = new Dom;
        $this->dom->load($html);
        // $puppeteer = new Puppeteer;
        // $browser = $puppeteer->launch();
        // $page = $browser->newPage();
        // $page->goto(config('bravebat.transparency_page'));
        // $data = $page->evaluate(JsFunction::createWithBody('return document.documentElement.outerHTML'));
        // $this->dom = new Dom;
        // $this->dom->load($data);
    }

    public function getBatPurchases()
    {
        $rows = $this->dom->find('.recent-transactions table tr');
        $results = [];
        foreach ($rows as $key => $row) {
            $elements = $row->find('td');
            $result = [];

            foreach ($elements as $key => $td) {
                if ($key == 0) {
                    $result['transaction_date'] = $td->text;
                } elseif ($key == 1) {
                    $result['transaction_amount'] = str_replace(',', '', $td->text);
                } elseif ($key == 2) {
                    $links = $td->find('a');
                    foreach ($links as $key1 => $link) {
                        $result['transaction_record'] = $link->text;
                    }
                }
            }
            if (count($result) == 3) {
                array_push($results, $result);
            }
        }
        return $results;
    }

    public function getAdCampaigns()
    {
        # code...
    }
}
