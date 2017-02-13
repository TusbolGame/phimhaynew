<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmActorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_actors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('actor_id')->unsigned();
			$table->foreign('actor_id')->references('id')->on('film_people')->onDelete('cascade');
			$table->string('actor_character', 100)->nullable();
			//$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_actors');
	}

}
