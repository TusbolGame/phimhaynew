<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmPeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('film_people', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('person_name', 100)->unique();
			$table->string('person_full_name', 100)->nullable(); 
			$table->string('person_birth_name', 100)->nullable();//ten khai sinh
			$table->string('person_birth_date', 100)->nullable();//ngay sinh
			$table->string('person_nick_name', 100)->nullable();//biet hieu
			$table->float('person_height')->nullable();//chieu cao
			//fix job change -> table film_job
			$table->string('person_info', 500)->nullable()->default('Đang cập nhật');//thong tin
			$table->string('person_image', 500)->nullable()->default('');//thong tin
			$table->integer('person_viewed')->unsinged()->default(0);//luot xem
			$table->string('person_dir_name')->nullable();//dir name
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
		Schema::drop('film_people');
	}

}
