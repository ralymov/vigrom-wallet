<?php

namespace App\Console\Commands;

use App\Currency;
use App\Services\ExchangeRateService;
use Illuminate\Console\Command;

class ImportExchangeRates extends Command
{
    protected $signature = 'currency:import';
    protected $description = 'Import currencies exchanges rate from openexchangerates.org';

    public function handle()
    {
        $currencies = implode(',', Currency::all('code')->pluck('code')->toArray());
        $fields = [
            'base' => config('currency.default'),
            'symbols' => $currencies
        ];
        $exchangeRates = ExchangeRateService::latest($fields)->rates;
        foreach ($exchangeRates as $currencyCode => $rate) {
            Currency::whereCode($currencyCode)->update(['exchange_rate' => $rate]);
        }
    }
}
