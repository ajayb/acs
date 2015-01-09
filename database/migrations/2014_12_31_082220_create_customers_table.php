<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('name', 50); 
            $table->string('type', 50);
            $table->boolean('is_non_profit')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->timestamps();           
        });
        
        Schema::table('customers', function($table)
        {
            $table->foreign('organization_id')->references('id')->on('organization');
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
        Schema::drop('customers');
    }

}
