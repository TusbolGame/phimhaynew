<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhimHayConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phim_hay_configs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('get_link_local')->default(1); // 1 la local, 0 remoted
			$table->string('get_link_remote_api')->nullable(); // address link remote server
			$table->boolean('get_link_episode_local')->default(1); // 1 -local, 0 remote
			$table->string('fb_app_id')->nullable()->default('367135626990588'); //id application fb
			$table->string('fb_page_url')->nullable()->default('https://www.facebook.com/PhimHay-396819140663825');
			$table->string('fb_page_name')->nullable()->default('PhimHay');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('phim_hay_configs');
	}

}
