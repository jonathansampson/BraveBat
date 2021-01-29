<?php

namespace App\Services;

use PHPHtmlParser\Dom;
use Spatie\Browsershot\Browsershot;

class UpholdService
{
    public function getDollarAmount($page)
    {
        $html = Browsershot::url($page)->waitUntilNetworkIdle()->bodyHtml();
        $dom = new Dom;
        $dom->loadStr($html);
        $debitContainer = $dom->find('.transaction-details-debited')->innerHtml;
        $dollarAmountString = trim(explode('USD', explode('$', $debitContainer)[1])[0]);
        $dollarAmount = floatval(str_replace(',', '', $dollarAmountString));
        return $dollarAmount;
    }
}
