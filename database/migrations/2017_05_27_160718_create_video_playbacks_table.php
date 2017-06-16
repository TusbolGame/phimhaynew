<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoPlaybacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_playbacks', function(Blueprint $table)
		{
			$table->string('id', 11);
			$table->primary('id');
			$table->index('id');
			$table->integer('film_id')->unsigned()->default(1);
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('film_source_id')->unsigned()->default(1);
			$table->foreign('film_source_id')->references('id')->on('film_source600s')->onDelete('cascade');
			$table->string('src_360p', 600)->nullable();
			$table->string('src_480p', 600)->nullable();
			$table->string('src_720p', 600)->nullable();
			$table->string('src_1080p', 600)->nullable();
			$table->string('src_2160p', 600)->nullable();
			$table->integer('time')->unsigned();
			$table->string('config')->nullable();
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
		Schema::drop('video_playbacks');
	}

}
