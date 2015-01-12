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
            $table->string('cost', 30);
            $table->integer('organization_id')->unsigned();
            $table->integer('customers_id')->unsigned(); 
            $table->string('type', 20);
            $table->integer('created_by')->unsigned();
            $table->string('trans_date', 30);
            $table->timestamps();
        });

        Schema::table('transactions', function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('organization_id')->references('id')->on('organization');
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->foreign('created_by')->references('id')->on('users');
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
