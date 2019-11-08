<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
        });
        Schema::create('transaction_reasons', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
        });
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->smallInteger('type_id');
            $table->foreign('type_id')->references('id')->on('transaction_types');
            $table->smallInteger('reason_id');
            $table->foreign('reason_id')->references('id')->on('transaction_reasons');
            $table->bigInteger('amount');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_types');
        Schema::dropIfExists('transaction_reasons');
    }
}
