<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDetailCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_detail_countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('film_countries')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_detail_countries');
	}

}
