<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('organization_id')->unsigned();   
            $table->integer('role_id')->unsigned();
            $table->string('name', 50);
            $table->string('email')->unique();
            $table->string('password', 60);            
            $table->rememberToken();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('users', function($table)
        {
            $table->foreign('organization_id')->references('id')->on('organization')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropForeign('users_organization_id_foreign');
            $table->dropForeign('users_roles_id_foreign');
        });

        Schema::drop('users');
    }

}
