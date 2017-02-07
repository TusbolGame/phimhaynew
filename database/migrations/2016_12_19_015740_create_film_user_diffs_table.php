<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmUserDiffsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_user_diffs', function(Blueprint $table)
		{
			$table->increments('id'); //user_id from id, users
			$table->foreign('id')->references('id')->on('users');
			$table->string('film_ticked', 1000)->default('{}');//save json
			$table->string('film_watched', 1000)->default('{}');//save json
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_user_diffs');
	}

}
