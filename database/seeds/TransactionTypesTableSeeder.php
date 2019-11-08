<?php

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['name' => 'debit', 'code' => TransactionType::DEBIT],
            ['name' => 'credit', 'code' => TransactionType::CREDIT],
        ];
        foreach ($records as $record) {
            TransactionType::updateOrCreate(['code' => $record['code']], $record);
        }
    }
}
