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
			$table->string('slider_name');
			$table->string('slider_dir', 300);
			$table->string('slider_image', 400);
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
		Schema::drop('film_sliders');
	}

}
