<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->char('code', 3)->unique();
            $table->decimal('exchange_rate', 19, 9)->default(1);
        });
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('amount')->default(0);
            $table->smallInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE wallets ADD CONSTRAINT non_negative_amount CHECK (amount >= 0);');
        Schema::table('users', function (Blueprint $table) {
            $table->integer('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wallet_id');
        });
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('currencies');
    }
}
