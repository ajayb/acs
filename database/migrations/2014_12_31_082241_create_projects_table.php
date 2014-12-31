<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->string('name', 100);
            $table->string('type', 30);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('projects', function($table)
        {
            $table->foreign('program_id')->references('id')->on('program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }

}
