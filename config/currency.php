<?php

use App\Currency;

return [
    /*
    |--------------------------------------------------------------------------
    | Default application currency
    |--------------------------------------------------------------------------
    |
    | The application currency determines the default currency that will be
    | used by the currency service provider. You are free to set this value
    | to any of the currencies which will be supported by the application.
    |
    */
    'default' => Currency::RUB,

    /*
    |--------------------------------------------------------------------------
    | API Key for OpenExchangeRates.org
    |--------------------------------------------------------------------------
    |
    */
    'api_key' => env('CURRENCY_API_KEY'),
];
