<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmTrailersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_trailers', function(Blueprint $table)
		{
			// $table->increments('id');
			$table->integer('id')->unsigned();
			$table->primary('id');
			$table->foreign('id')->references('id')->on('film_details')->onDelete('cascade');
			// $table->integer('film_link_number')->default(1);
			// $table->boolean('film_trailer_selected')->default(0);//get 1 link
			$table->char('film_episode_language', 3)->default('vs'); // vs, es, tm, raw, lt
			$table->string('film_src_remote', 300)->nullable(); //link in website anime47.com, phimmoi.net...
			$table->string('film_src_name', 20)->nullable();
			$table->string('film_src_full', 300)->nullable();
			$table->string('film_src_360p', 600)->nullable();
			$table->string('film_src_480p', 600)->nullable();
			$table->string('film_src_720p', 600)->nullable();
			$table->string('film_src_1080p', 600)->nullable();
			$table->string('film_src_2160p', 600)->nullable();
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
		Schema::drop('film_trailers');
	}

}
