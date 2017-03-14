<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('ip', 45); //ipv4 = 15, ipv6 = 39
			$table->string('country', 20)->nullable();
			$table->string('city', 20)->nullable();
			$table->integer('user_id')->nullable();
			$table->string('platform', 20)->nullable();
			$table->char('browser_name', 20)->nullable();
			$table->char('version', 20)->nullable();
			$table->string('referer_host', 30)->nullable();
			$table->integer('page_views')->unsigned()->default(0);
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
		Schema::drop('visits');
	}

}
