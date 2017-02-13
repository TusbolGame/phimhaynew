<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmPersonJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_person_jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('film_person_id')->unsigned();
			$table->foreign('film_person_id')->references('id')->on('film_people')->onDelete('cascade');
			$table->integer('film_job_id')->unsigned();
			$table->foreign('film_job_id')->references('id')->on('film_jobs')->onDelete('cascade');
			//$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('film_person_jobs');
	}

}
