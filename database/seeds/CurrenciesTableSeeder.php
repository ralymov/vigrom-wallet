<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['code' => Currency::RUB],
            ['code' => Currency::USD]
        ];
        foreach ($records as $record) {
            Currency::updateOrCreate(['code' => $record['code']], $record);
        }
    }
}
