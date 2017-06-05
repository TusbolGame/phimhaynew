<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_lists', function(Blueprint $table)
		{
			// $table->increments('id');
			$table->integer('id')->unsigned();
			$table->primary('id');
			$table->foreign('id')->references('id')->on('film_details')->onDelete('cascade');
			$table->string('film_name_en')->nullable();
			$table->string('film_name_vn')->nullable();
			$table->char('film_category', 2)->default('le'); //le, bo
			$table->integer('film_time')->nullable();
			$table->integer('film_years')->nullable();
			$table->char('film_quality', 8)->nullable(); // HD, Full HD, 2K
			$table->char('film_language', 15)->nullable(); // vs, es, tm, raw
			$table->string('film_thumbnail_small', 400);
			$table->float('film_vote')->default(0);
			$table->integer('film_vote_count')->default(0);
			$table->integer('film_viewed')->default(0);
			$table->string('film_dir_name', 500);
			$table->string('film_status', 30)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_lists');
	}

}
