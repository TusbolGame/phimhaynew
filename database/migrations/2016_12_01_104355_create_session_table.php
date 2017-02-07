<?php

use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function($t)
		{
			$t->string('id')->unique();
			$t->text('payload');
			$t->integer('last_activity');
			$t->integer('user_id')->nullable(); //total user login
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessions');
	}

}
