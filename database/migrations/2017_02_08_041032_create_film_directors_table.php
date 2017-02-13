<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDirectorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_directors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('director_id')->unsigned();
			$table->foreign('director_id')->references('id')->on('film_people')->onDelete('cascade');
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
		Schema::drop('film_directors');
	}

}
