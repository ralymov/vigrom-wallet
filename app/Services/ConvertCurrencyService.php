<?php

namespace App\Services;

use App\Currency;

class ConvertCurrencyService
{

    public static function convert(Currency $from, Currency $to, $amount)
    {
        $toRate = $to->exchange_rate;
        $fromRate = $from->exchange_rate;
        if ($from->code === config('currency.default')) {
            $result = $amount * $toRate;
        } else {
            //Convert Currencies
            $result = $toRate * ($amount / $fromRate);
        }
        return $result;
    }

}
