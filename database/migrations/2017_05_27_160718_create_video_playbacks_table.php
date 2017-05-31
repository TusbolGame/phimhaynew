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
			$table->string('redirect', 500)->nullable();
			$table->integer('time')->unsigned();
			$table->string('drive_cookie')->nullable();
			$table->tinyInteger('proxy')->default(0);
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
