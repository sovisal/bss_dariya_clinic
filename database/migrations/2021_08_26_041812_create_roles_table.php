<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255)->unique();
			$table->string('label')->nullable();
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('abilities', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255)->unique();
			$table->string('label', 255);
			$table->timestamps();
		});

		Schema::create('ability_role', function (Blueprint $table) {
			$table->primary(['role_id', 'ability_id']);
			
			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('ability_id');
			$table->timestamps();

			$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade');

			$table->foreign('ability_id')
					->references('id')
					->on('abilities')
					->onDelete('cascade');
		});

		Schema::create('role_user', function (Blueprint $table) {
			$table->primary(['user_id','role_id']);

			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('role_id');
			$table->timestamps();

			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');

			$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade');
		});

		Schema::create('ability_user', function (Blueprint $table) {
			$table->primary(['user_id', 'ability_id']);

			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('ability_id');
			$table->timestamps();

			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');

			$table->foreign('ability_id')
					->references('id')
					->on('abilities')
					->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
	}
}
