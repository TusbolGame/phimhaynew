<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permission_roles', function(Blueprint $table)
		{
			$table->integer('permission_id')->unsigned();
			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permission_roles');
	}

}
