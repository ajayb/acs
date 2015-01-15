<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotovoltaicTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photovoltaic', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('organization_id')->unsigned();
            $table->string('serial_number', 30);
            $table->string('kw_reading', 30);
            $table->string('carbon', 30);
            $table->string('reading_time', 30);                   
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('photovoltaic', function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::drop('photovoltaic');
    }

}
