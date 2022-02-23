<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('username')->unique();
			$table->string('password');
			$table->string('color', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->string('position', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->string('address', 255)->nullable();
			$table->boolean('gender')->default(false);
			$table->text('bio', 255)->nullable();
			$table->boolean('isWebDev')->default(false);
			$table->boolean('is_suspended')->default(false);
			$table->rememberToken();
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
		Schema::dropIfExists('users');
	}
}
