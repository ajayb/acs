<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('name', 100);
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('program', function($table)
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
        Schema::drop('program');
    }

}
