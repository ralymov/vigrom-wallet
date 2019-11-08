<?php

use App\Models\TransactionReason;
use Illuminate\Database\Seeder;

class TransactionReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['name' => 'stock', 'code' => TransactionReason::STOCK],
            ['name' => 'refund', 'code' => TransactionReason::REFUND],
        ];
        foreach ($records as $record) {
            TransactionReason::updateOrCreate(['code' => $record['code']], $record);
        }
    }
}
