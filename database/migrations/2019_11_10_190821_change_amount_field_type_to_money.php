<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeAmountFieldTypeToMoney extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE wallets
                    ALTER COLUMN amount TYPE numeric(19,2);');
        DB::statement('ALTER TABLE transactions
                    ALTER COLUMN amount TYPE numeric(19,2);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE wallets
                    ALTER COLUMN amount TYPE bigint;');
        DB::statement('ALTER TABLE transactions
                    ALTER COLUMN amount TYPE bigint;');
    }
}
