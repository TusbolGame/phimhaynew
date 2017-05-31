<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmSourceTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_source_tracks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_source_id')->unsigned();
			$table->foreign('film_source_id')->references('id')->on('film_sources')->onDelete('cascade');
			$table->char('film_track_type', 5); //vtt, ass
			$table->string('film_track_src', 400); //
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
		Schema::drop('film_source_tracks');
	}

}
