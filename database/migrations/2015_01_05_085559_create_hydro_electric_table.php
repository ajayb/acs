<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHydroElectricTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hydro_electric', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('production', 50);
            $table->string('unit', 50);
            $table->string('generator_number', 50);
            $table->string('generator_serial_number', 50);
            $table->dateTime('reading_time');
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('hydro_electric', function($table)
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
        Schema::drop('hydro_electric');
    }

}
