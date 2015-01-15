<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotovoltaicTransactionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photovoltaic_transactions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('photovoltaic_id')->unsigned();
            $table->integer('transaction_id')->unsigned();            
            $table->timestamps();
        });

        Schema::table('photovoltaic_transactions', function($table)
        {
            $table->foreign('photovoltaic_id')->references('id')->on('photovoltaic');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photovoltaic_transactions');
    }

}
