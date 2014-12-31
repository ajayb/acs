<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('amount', 30);
            $table->string('dolar_value', 30);
            $table->integer('buyer_id')->unsigned();
            $table->integer('seller_id')->unsigned(); 
            $table->string('type', 20);
            $table->timestamps();
        });

        Schema::table('transactions', function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('seller_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }

}
