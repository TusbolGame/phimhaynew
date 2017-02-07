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
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password', 60);
			$table->string('image')->default('icon-user-default.jpg');
			$table->string('email')->unique();
			$table->string('first_name');
			$table->string('last_name');
			$table->boolean('level')->default(2); /*1 - admin, 2 - member*/
			$table->boolean('actived')->default(0);
			$table->boolean('blocked')->default(0);
			// code is send mail active
			$table->string('active_hash', 100)->collate('latin1_general_ci')->nullable();
			// lay lai password
			$table->string('recover_hash', 100)->collate('latin1_general_ci')->nullable();
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
