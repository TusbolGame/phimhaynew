<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('film_info')->nullable();
			$table->float('film_score_imdb')->nullable();
			$table->integer('film_score_aw')->nullable();
			$table->char('film_release_date', 10)->nullable(); //20-02-1000
			$table->string('film_production_company')->nullable();
			$table->integer('film_relate_id')->unsigned()->default(0);//get table film_relates, phim lien quan, 0 - ko co phim lien quan
			$table->foreign('film_relate_id')->references('id')->on('film_relates');
			$table->string('film_thumbnail_big', 400);
			$table->string('film_poster_video', 400);
			$table->string('film_key_words')->nullable();
			$table->string('src_youtube_trailer', 100)->nullable();
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
		Schema::drop('film_details');
	}

}
