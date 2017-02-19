<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDetailTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_detail_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_id')->unsigned();
			$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('film_types')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_detail_types');
	}

}
