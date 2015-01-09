<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWindElectricalTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wind_electrical', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('address', 50);
            $table->string('lat_and_long', 50);
            $table->string('eia_plant_id', 50);
            $table->string('turbine_id', 50);
            $table->string('electicity', 50);
            $table->string('produced_kwh', 50);                        
            $table->dateTime('reading_time');
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });
        
        Schema::table('wind_electrical', function($table)
        {
            $table->foreign('project_id')->references('id')->on('projects');
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
         Schema::drop('wind_electrical');
    }

}
