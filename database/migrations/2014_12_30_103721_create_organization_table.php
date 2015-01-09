<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organization', function(Blueprint $table)
		{			
                        $table->engine ='InnoDB';
			$table->increments('id');
			$table->string('name',50);			
			$table->string('email', 80)->unique();
			$table->string('address')->nullable();
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('zip_code', 15)->nullable();			
			$table->boolean('status')->default(1);			
			$table->timestamps();			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('organization');
	}

}
