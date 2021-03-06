<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_sliders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_sliders');
	}

}
