<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;
use PHPHtmlParser\Dom;

class UpholdService
{
    public function getDollarAmount($page)
    {
        $html = Browsershot::url($page)->waitUntilNetworkIdle()->bodyHtml();
        $dom = new Dom;
        $dom->load($html);
        $debitContainer = $dom->find('.transaction-details-debited')->innerHtml;
        $dollarAmountString = trim(explode('USD', explode('$', $debitContainer)[1])[0]);
        $dollarAmount = floatval(str_replace(',', '', $dollarAmountString));
        return $dollarAmount;
    }
}
