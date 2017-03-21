<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmEpisodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_episodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('film_link_number')->default(1);
			$table->char('film_episode_language', 3)->default('vs'); // vs, es, tm, raw
			$table->char('film_episode_quality', 6)->default('720p'); // 360p, 480p, 720p, 1080p, 2160p
			$table->integer('film_episode')->default(0); // 0 - phim bo, 1-2-3..-phim le
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
		Schema::drop('film_episodes');
	}

}
